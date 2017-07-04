<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Seccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Seccion controller.
 *
 * @Route("admin/oferta_seccion")
 */
class SeccionController extends Controller
{
    /**
     * Lists all seccion entities.
     *
     * @Route("/", name="admin_oferta_seccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seccions = $em->getRepository('AppBundle:Seccion')->findAll();

        return $this->render('seccion/index.html.twig', array(
            'seccions' => $seccions,
        ));
    }

    /**
     * Creates a new seccion entity.
     *
     * @Route("/new", name="admin_oferta_seccion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $seccion = new Seccion();
        $form = $this->createForm('AppBundle\Form\SeccionType', $seccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seccion);
            $em->flush();

            return $this->redirectToRoute('admin_oferta_seccion_show', array('id' => $seccion->getId()));
        }

        return $this->render('seccion/new.html.twig', array(
            'seccion' => $seccion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seccion entity.
     *
     * @Route("/{id}", name="admin_oferta_seccion_show")
     * @Method("GET")
     */
    public function showAction(Seccion $seccion)
    {
        $deleteForm = $this->createDeleteForm($seccion);

        return $this->render('seccion/show.html.twig', array(
            'seccion' => $seccion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seccion entity.
     *
     * @Route("/{id}/edit", name="admin_oferta_seccion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seccion $seccion)
    {
        $deleteForm = $this->createDeleteForm($seccion);
        $editForm = $this->createForm('AppBundle\Form\SeccionType', $seccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_oferta_seccion_edit', array('id' => $seccion->getId()));
        }

        return $this->render('seccion/edit.html.twig', array(
            'seccion' => $seccion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seccion entity.
     *
     * @Route("/{id}", name="admin_oferta_seccion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seccion $seccion)
    {
        $form = $this->createDeleteForm($seccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seccion);
            $em->flush();
        }

        return $this->redirectToRoute('admin_oferta_seccion_index');
    }

    /**
     * Creates a form to delete a seccion entity.
     *
     * @param Seccion $seccion The seccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seccion $seccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_oferta_seccion_delete', array('id' => $seccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
