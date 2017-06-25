<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\PersonTypes;
use AppBundle\Form\PersonTypesType;
use AppBundle\Form\IndividualType;
use AppBundle\Entity\BusinessIndividual;
use AppBundle\Form\BusinessIndividualType;

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
        if ($form->isSubmitted() && $form->isValid()) {
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
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Individual');
        $individual = $repo->find($id);
        $form = $this->createForm(IndividualType::class, $individual);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $individual = $form->getData();
            $individual->setUpdated(new \DateTime());
            $individual->setUpdatedBy($user);
            $em->persist($individual);
            $em->flush();
            return $this->redirectToRoute('app_individual_list');
        }
        return $this->render('AppBundle:Individual:edit.html.twig', array(
                    'form' => $form->createView(),
                        // ...
        ));
    }

    /**
     * @Route("/individual/list")
     */
    public function listAction(EntityManagerInterface $em) {
        $repo = $em->getRepository('AppBundle:Individual');
        $individuals = $repo->createQueryBuilder('i')->orderBy('i.id', 'DESC')->getQuery()->getResult();
        return $this->render('AppBundle:Individual:list.html.twig', array(
                    'individuals' => $individuals,
                        // ...
        ));
    }

    /**
     * @Route("/individual/show/{id}")
     */
    public function showAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Individual');
        $individual = $repo->find($id);

        $businessIndividual = new BusinessIndividual();
        $businessIndividual->setIndividual($individual);
        $form = $this->createForm(BusinessIndividualType::class, $businessIndividual);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();
            $this->redirectToRoute('app_individual_show', ['id' => $id]);
        }

        $repoBusiness = $em->getRepository('AppBundle:BusinessIndividual');
        $business = $repoBusiness->findByIndividual($individual);

        return $this->render('AppBundle:Individual:show.html.twig', array(
                    // ...
                    'individual' => $individual,
                    'business' => $business,
                    'form' => $form->createView(),
        ));
    }
    
    /**
     * 
     * @Route("/business/remove-business/{id}")
     * @param Request $request
     * @param type $id
     */
    public function removeBusiness(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $bi = $em->getRepository('AppBundle:BusinessIndividual')->find($id);
        $individual_id = $bi->getIndividual()->getId();
        $em->remove($bi);
        $em->flush();
        return $this->redirectToRoute('app_individual_show',['id'=>$individual_id]);
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
