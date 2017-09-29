<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Periodo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Periodo controller.
 *
 * @Route("admin/periodo")
 */
class PeriodoController extends Controller
{
    /**
     * Lists all periodo entities.
     *
     * @Route("/", name="admin_periodo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $periodos = $em->getRepository('AppBundle:Periodo')->findBy(array(), array('idEstatus' => 'ASC'));

        return $this->render('periodo/index.html.twig', array(
            'periodos' => $periodos,
        ));
    }

    /**
     * Creates a new periodo entity.
     *
     * @Route("/new", name="admin_periodo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $periodo = new Periodo();
        $form = $this->createForm('AppBundle\Form\PeriodoType', $periodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($periodo);
            $em->flush();

            return $this->redirectToRoute('admin_periodo_show', array('id' => $periodo->getId()));
        }

        return $this->render('periodo/new.html.twig', array(
            'periodo' => $periodo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a periodo entity.
     *
     * @Route("/{id}", name="admin_periodo_show")
     * @Method("GET")
     */
    public function showAction(Periodo $periodo)
    {
        $deleteForm = $this->createDeleteForm($periodo);

        return $this->render('periodo/show.html.twig', array(
            'periodo' => $periodo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing periodo entity.
     *
     * @Route("/{id}/edit", name="admin_periodo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Periodo $periodo)
    {
        $deleteForm = $this->createDeleteForm($periodo);
        $editForm = $this->createForm('AppBundle\Form\PeriodoType', $periodo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_periodo_edit', array('id' => $periodo->getId()));
        }

        return $this->render('periodo/edit.html.twig', array(
            'periodo' => $periodo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a periodo entity.
     *
     * @Route("/{id}", name="admin_periodo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Periodo $periodo)
    {
        $form = $this->createDeleteForm($periodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($periodo);
            $em->flush();
        }

        return $this->redirectToRoute('admin_periodo_index');
    }

    /**
     * Creates a form to delete a periodo entity.
     *
     * @param Periodo $periodo The periodo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Periodo $periodo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_periodo_delete', array('id' => $periodo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
