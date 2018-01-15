<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SeccionComunidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Seccioncomunidad controller.
 *
 * @Route("admin/comunidad")
 */
class SeccionComunidadController extends Controller
{
    /**
     * Lists all seccionComunidad entities.
     *
     * @Route("/", name="admin_comunidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $seccionComunidads = $em->getRepository('AppBundle:SeccionComunidad')->findAll();

        return $this->render('seccioncomunidad/index.html.twig', array(
            'seccionComunidads' => $seccionComunidads,
        ));
    }

    /**
     * Creates a new seccionComunidad entity.
     *
     * @Route("/new", name="admin_comunidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $periodo = $this->getDoctrine()->getRepository("AppBundle:Periodo")->findOneByIdEstatus('1');
        $seccionComunidad = new Seccioncomunidad();
        $form = $this->createForm('AppBundle\Form\SeccionComunidadType', $seccionComunidad, array('periodo_activo' => $periodo));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seccionComunidad);
            $em->flush();

            return $this->redirectToRoute('admin_comunidad_show', array('id' => $seccionComunidad->getId()));
        }

        return $this->render('seccioncomunidad/new.html.twig', array(
            'seccionComunidad' => $seccionComunidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seccionComunidad entity.
     *
     * @Route("/{id}", name="admin_comunidad_show")
     * @Method("GET")
     */
    public function showAction(SeccionComunidad $seccionComunidad)
    {
        $deleteForm = $this->createDeleteForm($seccionComunidad);

        return $this->render('seccioncomunidad/show.html.twig', array(
            'seccionComunidad' => $seccionComunidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seccionComunidad entity.
     *
     * @Route("/{id}/edit", name="admin_comunidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SeccionComunidad $seccionComunidad)
    {
        $deleteForm = $this->createDeleteForm($seccionComunidad);
        $editForm = $this->createForm('AppBundle\Form\SeccionComunidadType', $seccionComunidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_comunidad_edit', array('id' => $seccionComunidad->getId()));
        }

        return $this->render('seccioncomunidad/edit.html.twig', array(
            'seccionComunidad' => $seccionComunidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seccionComunidad entity.
     *
     * @Route("/{id}", name="admin_comunidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SeccionComunidad $seccionComunidad)
    {
        $form = $this->createDeleteForm($seccionComunidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seccionComunidad);
            $em->flush();
        }

        return $this->redirectToRoute('admin_comunidad_index');
    }

    /**
     * Creates a form to delete a seccionComunidad entity.
     *
     * @param SeccionComunidad $seccionComunidad The seccionComunidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SeccionComunidad $seccionComunidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_comunidad_delete', array('id' => $seccionComunidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
