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
        // replace this example code with whatever you need
        /*$query = $this->getDoctrine()->getEntityManager()
            ->createQuery('SELECT u FROM AppBundle:User u WHERE NOT u.roles LIKE :role'
            )->setParameter('role', '%"ROLE_ADMIN"%' );
        $users = $query->getResult();*/


        $personas = count($this->getDoctrine()->getRepository("AppBundle:Persona")->findAll());
        $ea = count($this->getDoctrine()->getRepository("AppBundle:Inscripcion")->findAll());


        return $this->render('default/admin_index.html.twig', array(
            'inscritos' => $ea,
            'personas' => $personas
        ));
    }
}
