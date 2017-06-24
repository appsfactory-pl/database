<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\BusinessType;
use Symfony\Component\HttpFoundation\Request;
use \Doctrine\ORM\EntityManagerInterface;

class BusinessController extends Controller {

    /**
     * @Route("/business")
     */
    public function indexAction() {
        return $this->render('AppBundle:Business:index.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/business/list")
     */
    public function listAction(EntityManagerInterface $em) {
        $repository = $em->getRepository('AppBundle:Business');
        $business = $repository->createQueryBuilder('b')->orderBy('b.id','DESC')->getQuery()->getResult();
        return $this->render('AppBundle:Business:list.html.twig', array(
                        // ...
            'business'=>$business,
        ));
    }

    /**
     * @Route("/business/edit/{id}")
     */
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Business');
        $business = $repo->find($id);
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $business = $form->getData();
            $em->persist($business);
            $em->flush();
            return $this->redirectToRoute('app_business_list');
        }

        return $this->render('AppBundle:Business:edit.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/business/add")
     */
    public function addAction(Request $request) {
        $form = $this->createForm(BusinessType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $business = $form->getData();
            $em->persist($business);
            $em->flush();
            return $this->redirectToRoute('app_business_list');
        }
        return $this->render('AppBundle:Business:add.html.twig', array(
                    'form' => $form->createView(),
                        // ...
        ));
    }

    /**
     * @Route("/business/show/{id}")
     */
    public function showAction($id) {
        return $this->render('AppBundle:Business:show.html.twig', array(
                        // ...
        ));
    }

    /**
     * 
     * @Route("/business/import")
     */
    public function importAction() {

        return $this->render('AppBundle:Business:import.html.twig', [
        ]);
    }

}
