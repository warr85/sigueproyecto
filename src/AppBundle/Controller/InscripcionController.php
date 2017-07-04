<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Inscripcion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Inscripcion controller.
 *
 * @Route("sistema/inscripcion")
 */
class InscripcionController extends Controller
{
    /**
     * Lists all inscripcion entities.
     *
     * @Route("/", name="sistema_inscripcion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inscripcions = $em->getRepository('AppBundle:Inscripcion')->findAll();

        return $this->render('inscripcion/index.html.twig', array(
            'inscripcions' => $inscripcions,
        ));
    }

    /**
     * Creates a new inscripcion entity.
     *
     * @Route("/new", name="sistema_inscripcion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $inscripcion = new Inscripcion();
        $form = $this->createForm('AppBundle\Form\InscripcionType', $inscripcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inscripcion);
            $em->flush();

            return $this->redirectToRoute('sistema_inscripcion_show', array('id' => $inscripcion->getId()));
        }

        return $this->render('inscripcion/new.html.twig', array(
            'inscripcion' => $inscripcion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a inscripcion entity.
     *
     * @Route("/{id}", name="sistema_inscripcion_show")
     * @Method("GET")
     */
    public function showAction(Inscripcion $inscripcion)
    {
        $deleteForm = $this->createDeleteForm($inscripcion);

        return $this->render('inscripcion/show.html.twig', array(
            'inscripcion' => $inscripcion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing inscripcion entity.
     *
     * @Route("/{id}/edit", name="sistema_inscripcion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Inscripcion $inscripcion)
    {
        $deleteForm = $this->createDeleteForm($inscripcion);
        $editForm = $this->createForm('AppBundle\Form\InscripcionType', $inscripcion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sistema_inscripcion_edit', array('id' => $inscripcion->getId()));
        }

        return $this->render('inscripcion/edit.html.twig', array(
            'inscripcion' => $inscripcion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a inscripcion entity.
     *
     * @Route("/{id}", name="sistema_inscripcion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Inscripcion $inscripcion)
    {
        $form = $this->createDeleteForm($inscripcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inscripcion);
            $em->flush();
        }

        return $this->redirectToRoute('sistema_inscripcion_index');
    }

    /**
     * Creates a form to delete a inscripcion entity.
     *
     * @param Inscripcion $inscripcion The inscripcion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inscripcion $inscripcion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sistema_inscripcion_delete', array('id' => $inscripcion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
