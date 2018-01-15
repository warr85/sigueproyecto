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

        $institucionCoordinador = $this->getUser()->getInvitation()->getIdPersonaInstitucion()->getIdInstitucion()->getId();
        $peridoActivo = $em->getRepository("AppBundle:Periodo")->findOneByIdEstatus('1');
        $mallaInstitucion = $em->getRepository("AppBundle:MallaCurricularInstitucion")->findBy(array(
            'idInstitucion' => $institucionCoordinador
        ));

        $ofertaMalla = $em->getRepository("AppBundle:OfertaMallaCurricular")->findBy(array(
            'idPeriodo' => $peridoActivo,
            'idMallaCurricularInstitucion' => $mallaInstitucion
        ));

        $ofertaAcademica = $em->getRepository("AppBundle:OfertaAcademica")->findBy(array(
            'idOfertaMallaCurricular' => $ofertaMalla
        ));



        $seccions = $em->getRepository('AppBundle:Seccion')->findBy(array(
            'ofertaAcademica' => $ofertaAcademica
        ));


        return $this->render('seccion/index.html.twig', array(
            'seccions'  =>  $seccions,
            'periodo'   =>  $peridoActivo
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
        $em = $this->getDoctrine()->getManager();
        $seccion = new Seccion();
        $periodo = $em->getRepository("AppBundle:Periodo")->findOneByIdEstatus('1');
        $form = $this->createForm('AppBundle\Form\SeccionType', $seccion, array('periodo_activo' => $periodo));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($seccion);
            $em->flush();

            return $this->redirectToRoute('admin_oferta_seccion_index');
        }

        return $this->render('seccion/new.html.twig', array(
            'seccion' => $seccion,
            'form' => $form->createView(),
            'periodo' => $periodo
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
