<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/admin", name="adminpage")
     */
    public function adminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usersRepository = $em->getRepository('AppBundle:PersonaInstitucion');
        $qb = $usersRepository->createQueryBuilder('p');
        $qb->select('p')
            ->Where('p.roles LIKE :role')
            ->setParameter('role', '%"ROLE_ESTUDIANTE"%' );

        $estudiantes = count($qb->getQuery()->getResult());

        $usersRepository = $em->getRepository('AppBundle:PersonaInstitucion');
        $qb = $usersRepository->createQueryBuilder('p');
        $qb->select('p')
            ->Where('p.roles LIKE :role')
            ->setParameter('role', '%"ROLE_DOCENTE"%' );

        $docentes = count($qb->getQuery()->getResult());
        $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository("AppBundle:Periodo")->findOneByIdEstatus('1');
        $omc = $em->getRepository("AppBundle:OfertaMallaCurricular")->findBy(array('idPeriodo' => $periodo));
        $oa = $em->getRepository("AppBundle:OfertaAcademica")->findBy(array('idOfertaMallaCurricular' => $omc));
        $seccion = $em->getRepository("AppBundle:Seccion")->findBy(array('ofertaAcademica' => $oa));

        $ea = count($inscritos = $em->getRepository('AppBundle:Inscripcion')->findBy(
            array('idSeccion' => $seccion),
            array('id' => 'ASC')
        ));



        return $this->render('default/admin_index.html.twig', array(
            'inscritos' => $ea,
            'personas' => $estudiantes,
            'periodo'   => $periodo,
            'docentes' => $docentes
        ));
    }
}
