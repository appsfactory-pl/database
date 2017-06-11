<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends Controller {

    /**
     * @Route("/user/add")
     */
    public function addAction(Request $request) {
        return $this->render('AppBundle:User:add.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/user/list")
     */
    public function listAction(EntityManagerInterface $em) {
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('AppBundle:User:list.html.twig', array(
            'users' => $users,

        ));
    }

    /**
     * @Route("/user/edit/{id}", requirements={"id" = "\d+"})
     */
    public function editAction(Request $request, $id) {
        return $this->render('AppBundle:User:edit.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/user/delete/{id}", requirements={"id" = "\d+"})
     */
    public function deleteAction() {
        return $this->render('AppBundle:User:delete.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/user")
     */
    public function indexAction() {
        return $this->render('AppBundle:User:index.html.twig', array(
                        // ...
        ));
    }

}
