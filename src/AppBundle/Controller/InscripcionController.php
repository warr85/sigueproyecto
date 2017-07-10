<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EstadoAcademico;
use AppBundle\Entity\Inscripcion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Inscripcion controller.
 *
 * @Route("admin/inscripcion")
 */
class InscripcionController extends Controller
{
    /**
     * Lists all inscripcion entities.
     *
     * @Route("/", name="admin_inscripcion_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request, $estado=0)
    {


        $form = $this->createForm('AppBundle\Form\FindEstadoAcademicoType');


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $persona = $this->getDoctrine()->getRepository("AppBundle:Persona")->findOneByCedulaPasaporte($form['cedula']->getData());
            if($persona){
                $estado = $this->getDoctrine()->getRepository("AppBundle:EstadoAcademico")->findOneByIdPersonaInstitucion($persona->getInstituciones()[0]);
                return $this->redirectToRoute('admin_inscripcion_mostrar', array(
                    'id'        => $estado->getId()
                ));
            }
        }

        return $this->render('inscripcion/index.html.twig', array(
            'form'          => $form->createView(),
            'estado'        => $estado
        ));
    }



    /**
     * Lists all inscripcion entities.
     *
     * @Route("/mostrar/{id}", name="admin_inscripcion_mostrar")
     * @Method({"GET", "POST"})
     */
    public function MostrarAction(EstadoAcademico $estado, Request $request)
    {


        $form = $this->createForm('AppBundle\Form\FindEstadoAcademicoType');


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $persona = $this->getDoctrine()->getRepository("AppBundle:Persona")->findOneByCedulaPasaporte($form['cedula']->getData());
            if($persona){
                $estado = $this->getDoctrine()->getRepository("AppBundle:EstadoAcademico")->findOneByIdPersonaInstitucion($persona->getInstituciones()[0]);
                return $this->redirectToRoute('admin_inscripcion_mostrar', array(
                    'id'        => $estado->getId()
                ));
            }else{
                return $this->redirectToRoute('admin_inscripcion_index');
            }
        }

        return $this->render('inscripcion/mostrar.html.twig', array(
            'form'          => $form->createView(),
            'estado'        => $estado
        ));
    }

    /**
     * Creates a new inscripcion entity.
     *
     * @Route("/new/{id}", name="admin_inscripcion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(EstadoAcademico $estado, Request $request)
    {

        $oferta = $this->getDoctrine()->getRepository('AppBundle:OfertaAcademica')->findBy(
            array('idOfertaMallaCurricular'   =>  $estado->getIdMallaCurricular()),
            array('idMallaCurricularUc' => 'ASC')
        );



        $seccion = $this->getDoctrine()->getRepository('AppBundle:Seccion')->findAll();
        if ($request->isMethod("POST")) {
            //var_dump($request->request->get('seccion')['idSeccion']); exit;
            $em = $this->getDoctrine()->getManager();

            foreach ($request->request->get('seccion')['idSeccion'] as $s ){

                $secc = $this->getDoctrine()->getRepository('AppBundle:Seccion')->findOneById($s);
                $estatus = $this->getDoctrine()->getRepository('AppBundle:Estatus')->findOneById(2);

                $inscripcion = new Inscripcion();
                $inscripcion->setIdEstadoAcademico($estado);
                $inscripcion->setIdSeccion($secc);
                $inscripcion->setIdEstatus($estatus);
                $em->persist($inscripcion);
                $em->flush();
            }


            return $this->redirectToRoute('admin_inscripcion_mostrar', array(
                'id'        => $estado->getId()
            ));
        }

        return $this->render('inscripcion/new.html.twig', array(
            'estado'  => $estado,
            'oferta'       => $oferta,
            'seccion'       => $seccion,
        ));
    }

    /**
     * Finds and displays a inscripcion entity.
     *
     * @Route("/{id}", name="admin_inscripcion_show")
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
     * @Route("/{id}/edit", name="admin_inscripcion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Inscripcion $inscripcion)
    {
        $deleteForm = $this->createDeleteForm($inscripcion);
        $editForm = $this->createForm('AppBundle\Form\InscripcionType', $inscripcion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_inscripcion_edit', array('id' => $inscripcion->getId()));
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
     * @Route("/{id}", name="admin_inscripcion_delete")
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

        return $this->redirectToRoute('admin_inscripcion_index');
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
            ->setAction($this->generateUrl('admin_inscripcion_delete', array('id' => $inscripcion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
