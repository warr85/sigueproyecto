<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Persona;
use AppBundle\Entity\PersonaComunitaria;
use AppBundle\Entity\PersonaDiscapacidad;
use AppBundle\Entity\PersonaMision;
use AppBundle\Entity\PersonaSocioEconomico;
use AppBundle\Entity\PersonaInstitucion;
use AppBundle\Entity\Invitation;
use AppBundle\Entity\PersonaSolicitud;
use AppBundle\Entity\PersonaVotacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Null;

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

        $personas = $em->getRepository('AppBundle:Persona')->findBy(array(), array('id' => 'ASC'));
        $inscritos = $em->getRepository('AppBundle:Inscripcion')->findBy(array(), array('id' => 'ASC'));


        return $this->render('persona/index.html.twig', array(
            'personas' => $personas,
            'inscritos' => $inscritos
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
        $cne = new PersonaVotacion();
        $comunitaria = new PersonaComunitaria();

        $form = $this->createForm('AppBundle\Form\PersonaType', $persona);
        $formEconomico = $this->createForm('AppBundle\Form\PersonaSocioEconomicoType', $economico);
        $formInstitucion = $this->createForm('AppBundle\Form\PersonaInstitucionType', $institucion);
        $formDiscapacidad = $this->createForm('AppBundle\Form\PersonaDiscapacidadType', $discapacidad);
        $formCne = $this->createForm('AppBundle\Form\PersonaVotacionType', $cne);
        $formComunitaria = $this->createForm('AppBundle\Form\PersonaComunitariaType', $comunitaria);



        $form->handleRequest($request);
        $formEconomico->handleRequest($request);
        $formInstitucion->handleRequest($request);
        $formDiscapacidad->handleRequest($request);
        $formCne->handleRequest($request);
        $formComunitaria->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
             $em = $this->getDoctrine()->getManager();
             foreach ($persona->getFamiliares() as $familiar){
                 $familiar->setIdPersona($persona);
                 $persona->addFamiliare($familiar);
             }

             if($persona->getMisiones() != NULL) {
                 foreach ($persona->getMisiones() as $mision) {
                     $mision->setIdPersona($persona);
                     $persona->addMisione($mision);
                 }
             }

            if($persona->getTelefonos() != NULL) {
                foreach ($persona->getTelefonos() as $telefono) {
                    $telefono->setIdPersona($persona);
                    $persona->addTelefono($telefono);
                }
            }

             //asigna nacionalidad a la persona basado en su pais de nacimiento
             if($persona->getIdPaisNacimiento()->getId() == "197"){
                 $persona->setIdNacionalidad($this->getDoctrine()->getRepository("AppBundle:Nacionalidad")->findOneById('1'));
             }else{
                 $persona->setIdNacionalidad($this->getDoctrine()->getRepository("AppBundle:Nacionalidad")->findOneById('2'));
             }


            foreach ($institucion->getEstadosAcademicos() as $academico){
                $solicitud = new PersonaSolicitud();
                $solicitud->setIdPeriodo($this->getDoctrine()->getRepository("AppBundle:Periodo")->findOneByIdEstatus(1));
                $solicitud->setIdPersonaInstitucion($institucion);
                $solicitud->setIdTipoSolicitud($this->getDoctrine()->getRepository("AppBundle:TipoSolicitud")->findOneById(1));
                $solicitud->setIdEstatusProceso($this->getDoctrine()->getRepository("AppBundle:EstatusProceso")->findOneById(2));


                $academico->setIdPersonaInstitucion($institucion);
                $academico->setIdPeriodo($solicitud->getIdPeriodo());
                $academico->setIdPersonaSolicitud($solicitud);
                $academico->setIdGradoAcademico($em->getRepository("AppBundle:GradoAcademico")->findOneById(1));


                $em->persist($solicitud);
                $em->persist($academico);

                $institucion->addEstadosAcademico($academico);
            }

            if ($formEconomico->isValid() && $formInstitucion->isValid()){                

                $activo = $em->getRepository('AppBundle:Estatus')->findOneById(1);
                $em->persist($persona);
                $economico->setIdPersona($persona);
                $institucion->setIdPersona($persona);
                $institucion->setIdEstatus($activo);
                //var_dump($discapacidad->getIdDiscapacidad());
                if ($discapacidad->getIdDiscapacidad() != NULL) {
                    $discapacidad->setIdPersona($persona);
                    $em->persist($discapacidad);

                }

                if ($comunitaria->getNombre() != NULL) {
                    $comunitaria->setIdPersona($persona);
                    $em->persist($comunitaria);

                }

                if ($cne->getIdCentroVotacion()) {
                    $cne->setIdPersona($persona);
                    $em->persist($cne);

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
            'persona'           => $persona,
            'economico'         => $economico,
            'formEconomico'     => $formEconomico->createView(),
            'formInstitucion'   => $formInstitucion->createView(),
            'formDiscapacidad'  => $formDiscapacidad->createView(),
            'formCne'           => $formCne->createView(),
            'form'              => $form->createView(),
            'formComunitaria'   => $formComunitaria->createView(),
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
        //var_dump($persona->getMisiones());
        $deleteForm = $this->createDeleteForm($persona);       
        $economico = $this->getDoctrine()->getRepository('AppBundle:PersonaSocioEconomico')->findOneByIdPersona($persona);
        $discapacidades = $this->getDoctrine()->getRepository('AppBundle:PersonaDiscapacidad')->findOneByIdPersona($persona);
        $instituciones = $this->getDoctrine()->getRepository('AppBundle:PersonaInstitucion')->findOneByIdPersona($persona);
        $comunitaria = $this->getDoctrine()->getRepository('AppBundle:PersonaComunitaria')->findOneByIdPersona($persona);
        $mision = $this->getDoctrine()->getRepository('AppBundle:PersonaMision')->findOneByIdPersona($persona);



        if(!$economico){ $economico = new PersonaSocioEconomico(); }
        if(!$discapacidades){ $discapacidades = new PersonaDiscapacidad(); }
        if(!$instituciones){ $instituciones = new PersonaInstitucion(); }
        if(!$comunitaria){ $comunitaria = new PersonaComunitaria(); }
        if(!$mision){ $mision = new PersonaMision(); }


        $editPersona = $this->createForm('AppBundle\Form\PersonaType', $persona);
        $editEconomico = $this->createForm('AppBundle\Form\PersonaSocioEconomicoType', $economico);
        $editDiscapacidades = $this->createForm('AppBundle\Form\PersonaDiscapacidadType', $discapacidades);
        $editInstituciones = $this->createForm('AppBundle\Form\PersonaInstitucionType', $instituciones);
        $editComunitaria = $this->createForm('AppBundle\Form\PersonaComunitariaType', $comunitaria);
        $editMision = $this->createForm('AppBundle\Form\PersonaMisionType', $mision);


        $editPersona->handleRequest($request);
        $editEconomico->handleRequest($request);
        $editMision->handleRequest($request);




        $editDiscapacidades->handleRequest($request);
        $editInstituciones->handleRequest($request);
        $editComunitaria->handleRequest($request);


        if ($editPersona->isSubmitted() && $editPersona->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach ($persona->getFamiliares() as $familiar){
                $familiar->setIdPersona($persona);
                $persona->addFamiliare($familiar);
            }

            /*if($persona->getMisiones() != NULL) {
                foreach ($persona->getMisiones() as $mision) {
                    $mision->setIdPersona($persona);
                    $persona->addMisione($mision);
                }
            }*/


            foreach ($instituciones->getEstadosAcademicos() as $academico){

                $existe = $em->getRepository("AppBundle:EstadoAcademico")->findOneById($academico->getId());
                if(!$existe) {
                    $solicitud = new PersonaSolicitud();
                    $solicitud->setIdPeriodo($this->getDoctrine()->getRepository("AppBundle:Periodo")->findOneByIdEstatus(1));
                    $solicitud->setIdPersonaInstitucion($instituciones);
                    $solicitud->setIdTipoSolicitud($this->getDoctrine()->getRepository("AppBundle:TipoSolicitud")->findOneById(1));
                    $solicitud->setIdEstatusProceso($this->getDoctrine()->getRepository("AppBundle:EstatusProceso")->findOneById(2));


                    $academico->setIdPersonaInstitucion($instituciones);
                    $academico->setIdPeriodo($solicitud->getIdPeriodo());
                    $academico->setIdPersonaSolicitud($solicitud);
                    $academico->setIdGradoAcademico($em->getRepository("AppBundle:GradoAcademico")->findOneById(1));


                    $em->persist($solicitud);
                    $em->persist($academico);

                    $instituciones->addEstadosAcademico($academico);
                }
            }



            $economico->setIdPersona($persona);

            if($discapacidades->getIdDiscapacidad()) {
                $discapacidades->setIdPersona($persona);
                $em->persist($discapacidades);
            }

            if($comunitaria->getNombre()) {
                $comunitaria->setIdPersona($persona);
                $em->persist($comunitaria);
            }


            if($mision->getIdMision()) {
                $mision->setIdPersona($persona);
                $em->persist($mision);
            }


            $em->persist($persona);
            $em->persist($economico);
            $em->flush();

            return $this->redirectToRoute('admin_persona_edit', array('id' => $persona->getId()));
        }

        return $this->render('persona/edit.html.twig', array(
            'persona' => $persona,
            'edit_persona' => $editPersona->createView(),
            'edit_economico' => $editEconomico->createView(),
            'edit_discapacidades' => $editDiscapacidades->createView(),
            'edit_instituciones' => $editInstituciones->createView(),
            'edit_comunitaria' => $editComunitaria->createView(),
            'edit_mision' => $editMision->createView(),
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
