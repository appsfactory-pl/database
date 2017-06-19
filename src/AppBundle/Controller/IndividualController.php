<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndividualController extends Controller
{
    /**
     * @Route("/individual")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Individual:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/individual/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Individual:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/individual/edit/{id}")
     */
    public function editAction($id)
    {
        return $this->render('AppBundle:Individual:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/individual/list")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Individual:list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/individual/show/{id}")
     */
    public function showAction($id)
    {
        return $this->render('AppBundle:Individual:show.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/individual/import")
     */
    public function importAction()
    {
        return $this->render('AppBundle:Individual:import.html.twig', array(
            // ...
        ));
    }

}
