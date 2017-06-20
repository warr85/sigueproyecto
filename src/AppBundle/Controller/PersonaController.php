<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Persona;
use AppBundle\Entity\PersonaDiscapacidad;
use AppBundle\Entity\PersonaSocioEconomico;
use AppBundle\Entity\PersonaInstitucion;
use AppBundle\Entity\Invitation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Persona controller.
 *
 * @Route("admin/persona")
 */
class PersonaController extends Controller
{
    /**
     * Lists all persona entities.
     *
     * @Route("/", name="admin_persona_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personas = $em->getRepository('AppBundle:Persona')->findAll();

        return $this->render('persona/index.html.twig', array(
            'personas' => $personas,
        ));
    }

    /**
     * Creates a new persona entity.
     *
     * @Route("/new", name="admin_persona_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $persona = new Persona();
        $economico = new PersonaSocioEconomico();
        $institucion = new PersonaInstitucion();
        $discapacidad = new PersonaDiscapacidad();
        $form = $this->createForm('AppBundle\Form\PersonaType', $persona);
        $formEconomico = $this->createForm('AppBundle\Form\PersonaSocioEconomicoType', $economico);
        $formInstitucion = $this->createForm('AppBundle\Form\PersonaInstitucionType', $institucion);
        $formDiscapacidad = $this->createForm('AppBundle\Form\PersonaDiscapacidadType', $discapacidad);
        $form->handleRequest($request);
        $formEconomico->handleRequest($request);
        $formInstitucion->handleRequest($request);
        $formDiscapacidad->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             
            if ($formEconomico->isValid() && $formInstitucion->isValid()){                
                $em = $this->getDoctrine()->getManager();                 
                $activo = $em->getRepository('AppBundle:Estatus')->findOneById(1);
                $em->persist($persona);
                $economico->setIdPersona($persona);
                $institucion->setIdPersona($persona);
                $institucion->setIdEstatus($activo);

                if ($discapacidad->getIdDiscapacidad()) {
                    $discapacidad->setIdPersona($persona);
                    $em->persist($discapacidad);

                }


                $invitacion = new Invitation();
                $invitacion->setIdPersonaInstitucion($institucion);
                $invitacion->setCode($persona->getCedulaPasaporte());
                $invitacion->setEmail($persona->getCorreoElectronico());
                $invitacion->setSent(true);

                $em->persist($economico);
                $em->persist($institucion);
                $em->persist($invitacion);

                $em->flush();
            }else{
                return $this->redirectToRoute('admin_persona_show', array('id' => $persona->getId()));
            }

            return $this->redirectToRoute('admin_persona_show', array('id' => $persona->getId()));
        }

        return $this->render('persona/new.html.twig', array(
            'persona' => $persona,
            'economico' => $economico,
            'formEconomico' => $formEconomico->createView(),
            'formInstitucion' => $formInstitucion->createView(),
            'formDiscapacidad' => $formDiscapacidad->createView(),
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a persona entity.
     *
     * @Route("/{id}", name="admin_persona_show")
     * @Method("GET")
     */
    public function showAction(Persona $persona)
    {
        $deleteForm = $this->createDeleteForm($persona);

        return $this->render('persona/show.html.twig', array(
            'persona' => $persona,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing persona entity.
     *
     * @Route("/{id}/edit", name="admin_persona_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Persona $persona)
    {
        $deleteForm = $this->createDeleteForm($persona);       
        $economico = $this->getDoctrine()->getRepository('AppBundle:PersonaSocioEconomico')->findOneByIdPersona($persona);


        if(!$economico){ $economico = new PersonaSocioEconomico(); }

        $editPersona = $this->createForm('AppBundle\Form\PersonaType', $persona);
        $editEconomico = $this->createForm('AppBundle\Form\PersonaSocioEconomicoType', $economico);
        $editPersona->handleRequest($request);
        $editEconomico->handleRequest($request);


        if ($editPersona->isSubmitted() && $editPersona->isValid()) {
            $economico->setIdPersona($persona);
            $em = $this->getDoctrine()->getManager();
            $economico->setIdPersona($persona);
            $em->persist($persona);
            $em->persist($economico);
            $em->flush();

            return $this->redirectToRoute('admin_persona_edit', array('id' => $persona->getId()));
        }

        return $this->render('persona/edit.html.twig', array(
            'persona' => $persona,
            'edit_persona' => $editPersona->createView(),
            'edit_economico' => $editEconomico->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a persona entity.
     *
     * @Route("/{id}", name="admin_persona_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Persona $persona)
    {
        $form = $this->createDeleteForm($persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($persona);
            $em->flush();
        }

        return $this->redirectToRoute('admin_persona_index');
    }

    /**
     * Creates a form to delete a persona entity.
     *
     * @param Persona $persona The persona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Persona $persona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_persona_delete', array('id' => $persona->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
