<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/user/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:User:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/user/list")
     */
    public function listAction()
    {
        return $this->render('AppBundle:User:list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/user/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:User:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/user/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:User:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/user")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:User:index.html.twig', array(
            // ...
        ));
    }

}
