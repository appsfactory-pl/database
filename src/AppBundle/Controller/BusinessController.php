<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AddressHistory;
use AppBundle\Form\BusinessAddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\BusinessType;
use Symfony\Component\HttpFoundation\Request;
use \Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\BusinessIndividualType;
use AppBundle\Entity\BusinessIndividual;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Entity\Business;
use AppBundle\Entity\Individual;
use AppBundle\Entity\PersonTypes;
use AppBundle\Form\FileType;
use AppBundle\Form\AddressHistoryType;
use AppBundle\Form\BusinessSearchType;

class BusinessController extends Controller
{

    /**
     * @Route("/business")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Business:index.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/business/list")
     */
    public function listAction(EntityManagerInterface $em)
    {
        $repository = $em->getRepository('AppBundle:Business');
        $business = $repository->createQueryBuilder('b')->orderBy('b.id', 'DESC')->getQuery()->getResult();
        return $this->render('AppBundle:Business:list.html.twig', array(
            // ...
            'business' => $business,
        ));
    }

    /**
     * @Route("/business/edit/{id}")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Business');
        $business = $repo->find($id);
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $business = $form->getData();
            $em->persist($business);
            $em->flush();
            return $this->redirectToRoute('app_business_show', ['id' => $id]);
        }

        return $this->render('AppBundle:Business:edit.html.twig', array(
            // ...
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/business/add")
     */
    public function addAction(Request $request)
    {
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
    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Business');
        $business = $repo->find($id);
        $businessIndividual = new BusinessIndividual();
        $businessIndividual->setBusiness($business);
        $form = $this->createForm(BusinessIndividualType::class, $businessIndividual);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = new BusinessIndividual();
            $data->setType($form->get('type')->getData());
            $data->setBusiness($form->get('business')->getData());
            $data->setIndividual($form->get('individual')->getData());
            $em->persist($data);
            $em->flush();
            $this->redirectToRoute('app_business_show', ['id' => $id]);
        }

        $fileForm = $this->createForm(FileType::class);
        $fileForm->handleRequest($request);
        if ($fileForm->isSubmitted() && $fileForm->isValid()) {
            $uploadedFile = $fileForm['file']->getData();
            $newFileName = $business->getId() . '_business_' . $uploadedFile->getClientOriginalName();
            $path = '/files/';
            $dir = $_SERVER['DOCUMENT_ROOT'] . $path;
            $uploadedFile->move($dir, $newFileName);
//            var_dump($uploadedFile);
            $data = $fileForm->getData();
            $data->setPath($path);
            $data->setFileName($newFileName);
            $data->setBusiness($business);
            $data->setAdded(new \DateTime());
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('app_business_show', ['id' => $id]);
        }
        $filesRepo = $em->getRepository('AppBundle:File');
        $files = $filesRepo->findByBusiness($business);

        $addressHistoryForm = $this->createForm(AddressHistoryType::class);
        $addressHistoryForm->handleRequest($request);
        $addressHistoryRepo = $em->getRepository('AppBundle:AddressHistory');
        $addressHistory = $addressHistoryRepo->findByBusiness($business);

        if ($addressHistoryForm->isSubmitted() && $addressHistoryForm->isValid()) {
            $data = $addressHistoryForm->getData();
            $data->setBusiness($business);
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('app_business_show', ['id' => $id]);
        }

        $repoIndividual = $em->getRepository('AppBundle:BusinessIndividual');
        $individuals = $repoIndividual->findByBusiness($business);
        return $this->render('AppBundle:Business:show.html.twig', array(
            // ...
            'business' => $business,
            'individuals' => $individuals,
            'form' => $form->createView(),
            'fileForm' => $fileForm->createView(),
            'files' => $files,
            'addressHistoryForm' => $addressHistoryForm->createView(),
            'addressHistory' => $addressHistory,
        ));
    }

    /**
     *
     * @Route("/business/remove-individual/{id}")
     * @param Request $request
     * @param type $id
     */
    public function removeIndividual(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $bi = $em->getRepository('AppBundle:BusinessIndividual')->find($id);
        $business_id = $bi->getBusiness()->getId();
        $em->remove($bi);
        $em->flush();
        return $this->redirectToRoute('app_business_show', ['id' => $business_id]);
    }

    /**
     *
     * @Route("/business/import")
     */
    public function importAction(Request $request)
    {

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
//                var_dump($data);
//                die;
                $user = $this->getUser();
                foreach ($data as $k => $item) {
                    $business_id = $item['ID_B'];
                    if (empty($business_id)) {
                        $this->addFlash('error', 'Incorrect file type. You can import only CSV files.');
                        $this->redirectToRoute('app_business_import');
                    }
                    $business = $business_repo->findOneById2($business_id);

//                    var_dump($business,$business_id); die;
                    if (empty($business)) {
                        $business = new Business();
                        $business->setId2($business_id);
                    }
                    if ($item['bdoi'] == '0000-00-00') {
                        $item['bdoi'] = null;
                    }
                    $business->setName($item['bname']);
                    $business->setAddress($item['baddress']);
                    $business->setPostcode($item['bpostcode']);
                    $business->setDoi($item['bdoi']);
                    $business->setCno($item['bcno']);
                    $business->setUtr($item['butr']);
                    $business->setVat($item['bvat']);
                    $business->setEpaye($item['bepaye']);
                    $business->setAccoff($item['baccoff']);
                    $business->setAccount($item['baccount']);
                    $business->setNotes(nl2br($item['bnotes']));
                    $em->persist($business);
                    $em->flush();

                    $individual_id = $item['Bconnection_1'];
                    $individual = $individual_repo->findOneById2($individual_id);
                    if (empty($individual)) {
                        $individual = new Individual();
                        $individual->setId2($individual_id);
                        $individual->setTitle('mr');
                        $individual->setForename($item['Bconnection_1_name']);
                        $individual->setLastname($item['Bconnection_1_name']);
                        $individual->setDob(null);
                        $individual->setCreated(new \DateTime());
                        $individual->setCreatedBy($user);
                        $individual->setUpdated(new \DateTime());
                        $individual->setUpdatedBy($user);
                        $individual->setNotes(nl2br($item['Bconnection_1_name']));
                        $em->persist($individual);
                        $em->flush();
                    }
                    $business_individual = $business_individual_repo->findOneBy([
                        'individual' => $individual,
                        'business' => $business,
                    ]);
                    if (empty($business_individual)) {
                        $type = $person_types_repo->findOneByName($item['Bconnection_1_type']);
                        if (empty($type)) {
                            $type = new PersonTypes();
                            $type->setName($item['Bconnection_1_type']);
                            $em->persist($type);
                        }
                        $business_individual = new BusinessIndividual();
                        $business_individual->setBusiness($business);
                        $business_individual->setIndividual($individual);
                        $business_individual->setType($type);
                        $em->persist($business_individual);
                        $em->flush();
                    }

//                    $em->flush();
                }
                $this->addFlash('success', 'Data imported successfuly.');
                $this->redirectToRoute('app_business_import');
            } else {
                $this->addFlash('error', 'Incorrect file type. You can import only CSV files.');
                $this->redirectToRoute('app_business_import');
            }
        }
        return $this->render('AppBundle:Business:import.html.twig', [
        ]);
    }

    /**
     *
     * @param Request $request
     * @Route("/business/advanced-search",name="business_advanced_search")
     */
    public function advancedSearchAction(Request $request)
    {
        $form = $this->createForm(BusinessSearchType::class);
        $form->handleRequest($request);
        $business = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository("AppBundle:Business");
            $query = $repo->createQueryBuilder('b');
            $data = $form->getData();
            $string = $data->getString();

            $query->andWhere('b.id2 = :data_int 
            OR b.name LIKE :data_like 
            OR b.cno LIKE :data_like 
            OR b.telephone LIKE :data_like 
            OR b.email LIKE :data_like 
            OR b.address LIKE :data_like 
            OR b.postcode LIKE :data_like
            OR b.vat LIKE :data_like
            OR b.utr LIKE :data_like
            OR b.epaye LIKE :data_like
            OR b.accoff LIKE :data_like
            OR b.archiveNote LIKE :data_like
            OR b.notes LIKE :data_like
            OR b.accountsOffice LIKE :data_like
            ')
                ->setParameter('data_like', '%' . $string . '%')
                ->setParameter('data_int', (int)$string);
            if (!empty($data->getStatus())) {
                $query->andWhere('b.status=:status')
                    ->setParameter('status', $data->getStatus());
            }

            if (!empty($data->getLegalForm())) {
                $query->andWhere('b.legalForm=:legalForm')
                    ->setParameter('legalForm', $data->getLegalForm());
            }

            if (!empty($data->getDateDisengagedFrom())) {
                $query->andWhere('b.dateDisengaged> = :dateDisengagedFrom')
                    ->setParameter('dateDisengagedFrom', $data->getDateDisengagedFrom());
            }
            if (!empty($data->getDateDisengagedTo())) {
                $query->andWhere('b.dateDisengaged <= :dateDisengagedTo')
                    ->setParameter('dateDisengagedTo', $data->getDateDisengagedTo());
            }
            if (!empty($data->getDisengegementReason())) {
                $query->andWhere('b.disengegementReason = :disengegementReason')
                    ->setParameter('disengegementReason', $data->getDisengegementReason());
            }

            if (!empty($data->getArchivedFrom())) {
                $query->andWhere('b.archived> = :dateArchivedFrom')
                    ->setParameter('dateArchivedFrom', $data->getArchivedFrom());
            }
            if (!empty($data->getArchivedTo())) {
                $query->andWhere('b.dateDisengaged <= :dateArchivedTo')
                    ->setParameter('dateArchivedTo', $data->getArchivedTo());
            }
            if (!empty($data->getConnections())) {
                $businessToIndividualRepo = $em->getRepository('AppBundle:BusinessIndividual');
                $cI = $businessToIndividualRepo->findAll();
                $ids = [0];
                if (!empty($cI)) {
                    foreach ($cI as $item) {
                        if (!empty($item->getBusiness()) && !in_array($item->getBusiness()->getId(), $ids)) {
                            $ids[] = $item->getBusiness()->getId();
                        }
                    }
                }
                $query->andWhere('b.id IN (:ids)')
                    ->setParameter('ids', $ids);
            }
            if (!empty($data->getProofOfAddress())) {
                $repoFiles = $em->getRepository('AppBundle:File');
                $repoFileType = $em->getRepository('AppBundle:FileType');
                $fileType = $repoFileType->findOneByName('Proof Of Address');
                $qq = $repoFiles->createQueryBuilder('f')
                    ->where('f.type = :type')
                    ->setParameter('type', $fileType)
                    ->getQuery();
                $files = $qq->getResult();
                $ids = [0];
                foreach ($files as $file) {
                    if (!empty($file->getBusiness())) {
                        $ids[] = $file->getBusiness()->getId();
                    }
                }
                if ($data->getProofOfAddress() == 'yes') {
                    $query->andWhere('b.id IN (:ids)')
                        ->setParameter('ids', $ids);
                } else {
                    $query->andWhere('NOT b.id IN (:ids)')
                        ->setParameter('ids', $ids);
                }
            }
            $q = $query->getQuery();
            $business = $q->getResult();
        }

        return $this->render('AppBundle:Business:advanced-search.html.twig', [
            'form' => $form->createView(),
            'business' => $business,
        ]);

    }

    /**
     * @param Request $request
     * @param string $id
     * @Route("/business/add-address/{id}", name="business_add_address")
     */
    public function addAddressAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Business');
        $business = $repo->find($id);
        $addressHistory = new AddressHistory();
        $addressHistory->setAddress($business->getAddress());
        $addressHistory->setBusiness($business);
        $addressHistory->setPostcode($business->getPostcode());
        $addressHistory->setDateMovedIn($business->getDateMovedIn());

        $form = $this->createForm(BusinessAddressType::class, $business);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($addressHistory);
            $em->flush();
            $data = $form->getData();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('app_business_show',['id'=>$id]);
        }
        return $this->render('@App/Business/add_address.html.twig',[
            'form' => $form->createView(),
        ]);

    }
}
