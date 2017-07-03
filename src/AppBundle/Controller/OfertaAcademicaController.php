<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OfertaAcademica;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ofertaacademica controller.
 *
 * @Route("admin/ofertaacademica")
 */
class OfertaAcademicaController extends Controller
{
    /**
     * Lists all ofertaAcademica entities.
     *
     * @Route("/", name="admin_ofertaacademica_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ofertaAcademicas = $em->getRepository('AppBundle:OfertaAcademica')->findAll();

        return $this->render('ofertaacademica/index.html.twig', array(
            'ofertaAcademicas' => $ofertaAcademicas,
        ));
    }

    /**
     * Creates a new ofertaAcademica entity.
     *
     * @Route("/new", name="admin_ofertaacademica_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ofertaAcademica = new Ofertaacademica();
        $form = $this->createForm('AppBundle\Form\OfertaAcademicaType', $ofertaAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ofertaAcademica);
            $em->flush();

            return $this->redirectToRoute('admin_ofertaacademica_show', array('id' => $ofertaAcademica->getId()));
        }

        return $this->render('ofertaacademica/new.html.twig', array(
            'ofertaAcademica' => $ofertaAcademica,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ofertaAcademica entity.
     *
     * @Route("/{id}", name="admin_ofertaacademica_show")
     * @Method("GET")
     */
    public function showAction(OfertaAcademica $ofertaAcademica)
    {
        $deleteForm = $this->createDeleteForm($ofertaAcademica);

        return $this->render('ofertaacademica/show.html.twig', array(
            'ofertaAcademica' => $ofertaAcademica,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ofertaAcademica entity.
     *
     * @Route("/{id}/edit", name="admin_ofertaacademica_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OfertaAcademica $ofertaAcademica)
    {
        $deleteForm = $this->createDeleteForm($ofertaAcademica);
        $editForm = $this->createForm('AppBundle\Form\OfertaAcademicaType', $ofertaAcademica);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_ofertaacademica_edit', array('id' => $ofertaAcademica->getId()));
        }

        return $this->render('ofertaacademica/edit.html.twig', array(
            'ofertaAcademica' => $ofertaAcademica,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ofertaAcademica entity.
     *
     * @Route("/{id}", name="admin_ofertaacademica_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OfertaAcademica $ofertaAcademica)
    {
        $form = $this->createDeleteForm($ofertaAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ofertaAcademica);
            $em->flush();
        }

        return $this->redirectToRoute('admin_ofertaacademica_index');
    }

    /**
     * Creates a form to delete a ofertaAcademica entity.
     *
     * @param OfertaAcademica $ofertaAcademica The ofertaAcademica entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OfertaAcademica $ofertaAcademica)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_ofertaacademica_delete', array('id' => $ofertaAcademica->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
