<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BusinessController extends Controller
{
    /**
     * @Route("/business")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Business:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/business/list")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Business:list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/business/edit/{id}")
     */
    public function editAction($id)
    {
        return $this->render('AppBundle:Business:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/business/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Business:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/business/show/{id}")
     */
    public function showAction($id)
    {
        return $this->render('AppBundle:Business:show.html.twig', array(
            // ...
        ));
    }
    
    /**
     * 
     * @Route("/business/import")
     */
    public function importAction(){
        
        return $this->render('AppBundle:Business:import.html.twig',[
            
        ]);
    }

}
