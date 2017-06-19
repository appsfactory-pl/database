<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\BusinessType;
use Symfony\Component\HttpFoundation\Request;

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
    public function addAction(Request $request)
    {
        $form = $this->createForm(BusinessType::class);
        $form->handleRequest($request);
        return $this->render('AppBundle:Business:add.html.twig', array(
            'form' => $form->createView(),
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
