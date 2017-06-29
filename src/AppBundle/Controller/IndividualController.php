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
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Entity\Business;
use AppBundle\Entity\Individual;

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
    public function removeBusiness(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $bi = $em->getRepository('AppBundle:BusinessIndividual')->find($id);
        $individual_id = $bi->getIndividual()->getId();
        $em->remove($bi);
        $em->flush();
        return $this->redirectToRoute('app_individual_show', ['id' => $individual_id]);
    }

    /**
     * @Route("/individual/import")
     */
    public function importAction() {

        if (!empty($_FILES['xls-file']['tmp_name'])) {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/import/' . $_FILES['xls-file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if ($ext == 'csv') {
                $em = $this->getDoctrine()->getManager();
                $business_repo = $em->getRepository('AppBundle:Business');
                $business_individual_repo = $em->getRepository('AppBundle:BusinessIndividual');
                $individual_repo = $em->getRepository('AppBundle:Individual');
                $person_types_repo = $em->getRepository('AppBundle:PersonTypes');
                move_uploaded_file($_FILES['xls-file']['tmp_name'], $filename);
                $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
                $data = $serializer->decode(file_get_contents($filename), 'csv');
                $user = $this->getUser();
                foreach ($data as $k => $item) {
                    $individual_id = $item['ID_I'];

//  'I_connection_1' => string '' (length=0)
//  'I_connection_1_type' => string '' (length=0)
//  'I_connection_1_name' => string '' (length=0)
//  'I_connection_2' => string '5' (length=1)
//  'I_connection_2_type' => string 'Business' (length=8)
//  'I_connection_2_name' => string 'Maja Polish Deli Limited' (length=24)
//  'ID' => string '' (length=0)


                    $individual = $individual_repo->find($individual_id);
                    if (empty($individual)) {
                        $individual = new Individual();
                        $individual->setId($individual_id);
                    }
                    if ($item['dob'] == '0000-00-00') {
                        $item['dob'] = null;
                    }

                    $individual->setTitle($item['title']);
                    $individual->setForename($item['forename']);
                    $individual->setMiddlename($item['middlename']);
                    $individual->setLastname($item['lastname']);
                    $individual->setMaidenname($item['maidenname']);
                    $individual->setDob($item['dob']);
                    $individual->setPhone($item['phone']);
                    $individual->setPhone2($item['phone2']);
                    $individual->setEmail($item['email']);
                    $individual->setAddress($item['address']);
                    $individual->setPostcode($item['postcode']);
                    $individual->setNin($item['nin']);
                    $individual->setUtr($item['utr']);

                    $individual->setCreated(new \DateTime());
                    $individual->setCreatedBy($user);
                    $individual->setUpdated(new \DateTime());
                    $individual->setUpdatedBy($user);
                    $individual->setNotes(nl2br($item['notes']));
                    $individual->setNotesChildren($item['notes wth children']);
                    $em->persist($individual);

                    $business_id = $item['I_connection_2'];
                    $business = $business_repo->find($item['I_connection_2']);
                    if (empty($business)) {
                        $business = new Business();
                        $business->setId($business_id);
                        $business->setName($item['I_connection_2_name']);
                        $business->setAddress($item['I_connection_2_name']);
                        $business->setPostcode($item['I_connection_2_name']);
                        $business->setDoi(null);
                        $business->setCno(1);
//                        $business->setUtr($item['butr']);
//                        $business->setVat($item['bvat']);
//                        $business->setEpaye($item['bepaye']);
//                        $business->setAccoff($item['baccoff']);
//                        $business->setAccount($item['baccount']);
//                        $business->setNotes(nl2br($item['bnotes']));
                        $em->persist($business);
                    }

                    $business_individual = $business_individual_repo->findOneBy([
                        'individual' => $individual,
                        'business' => $business,
                    ]);
                    if (empty($business_individual)) {
                        $type = $person_types_repo->findOneByName($item['I_connection_2_type']);
                        if (empty($type)) {
                            $type = new PersonTypes();
                            $type->setName($item['I_connection_2_type']);
                            $em->persist($type);
                        }
                        $business_individual = new BusinessIndividual();
                        $business_individual->setBusiness($business);
                        $business_individual->setIndividual($individual);
                        $business_individual->setType($type);
                        $em->persist($business_individual);
                    }

                    $em->flush();
                }
                $this->addFlash('success', 'Data imported successfuly.');
                $this->redirectToRoute('app_individual_import');
            } else {
                $this->addFlash('error', 'Incorrect file type. You can import only CSV files.');
                $this->redirectToRoute('app_individual_import');
            }
        }

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
