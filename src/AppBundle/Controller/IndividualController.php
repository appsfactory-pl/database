<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\PersonTypes;
use AppBundle\Form\PersonTypesType;
use AppBundle\Form\IndividualType;

class IndividualController extends Controller {

    /**
     * @Route("/individual")
     */
    public function indexAction() {
        return $this->render('AppBundle:Individual:index.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/individual/add")
     */
    public function addAction(Request $request) {
        $form = $this->createForm(IndividualType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $individual = $form->getData();
            $user = $this->getUser();
            $individual->setCreated(new \DateTime());
            $individual->setCreatedBy($user);
            $individual->setUpdated(new \DateTime());
            $individual->setUpdatedBy($user);
            $em->persist($individual);
            $em->flush();
            return $this->redirectToRoute('app_individual_list');

        }
        return $this->render('AppBundle:Individual:add.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/individual/edit/{id}")
     */
    public function editAction($id) {
        return $this->render('AppBundle:Individual:edit.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/individual/list")
     */
    public function listAction() {
        return $this->render('AppBundle:Individual:list.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/individual/show/{id}")
     */
    public function showAction($id) {
        return $this->render('AppBundle:Individual:show.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/individual/import")
     */
    public function importAction() {
        return $this->render('AppBundle:Individual:import.html.twig', array(
                        // ...
        ));
    }

    /**
     * 
     * @Route("/individual/types")
     */
    public function typesAction(EntityManagerInterface $em) {
        $repository = $em->getRepository('AppBundle:PersonTypes');
        $types = $repository->findAll();
        return $this->render('AppBundle:Individual:types.html.twig', array(
                    'types' => $types,
                        // ...
        ));
    }

    /**
     * 
     * @Route("/individual/add-type")
     */
    public function addTypeAction(Request $request) {
        $form = $this->createForm(PersonTypesType::class);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $type = new PersonTypes();
            $type->setName($form->get('name')->getData());
            $em->persist($type);
            $em->flush();
            return $this->redirectToRoute('app_individual_types');
        }
        return $this->render('AppBundle:Individual:add-type.html.twig', array(
                    'form' => $form->createView(),
                        // ...
        ));
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/individual/edit-type/{id}")
     */
    public function editTypeAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:PersonTypes');
        $type = $repository->find($id);
        $form = $this->createForm(PersonTypesType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $type->setName($form->get('name')->getData());
            $em->persist($type);
            $em->flush();
            return $this->redirectToRoute('app_individual_types');
        }
        return $this->render('AppBundle:Individual:edit-type.html.twig', array(
                    'form' => $form->createView(),
                        // ...
        ));
    }

}
