<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

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

    /**
     * 
     * @Route("/individual/types")
     */
    public function typesAction(EntityManagerInterface $em)
    {
        return $this->render('AppBundle:Individual:types.html.twig', array(
            // ...
        ));
    }
    
    /**
     * 
     * @Route("/individual/add-type")
     */
    public function addTypeAction(Request $request){
        return $this->render('AppBundle:Individual:add-type.html.twig', array(
            // ...
        ));
    }
    
    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/individual/edit-type/{id}")
     */
    public function editTypeAction(Request $request,$id){
        return $this->render('AppBundle:Individual:edit-type.html.twig', array(
            // ...
        ));
    }
}
