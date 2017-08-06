<?php

namespace AppBundle\Controller;

use AppBundle\Form\AddressHistoryType;
use AppBundle\Form\SearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        if (empty($this->getUser())) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $individuals = [];
        $businesses = [];
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $d = $form->getData();
            $string = $d['string'];
            if (strlen($string) > 2) {
                $individualRepo = $em->getRepository('AppBundle:Individual');
                $query = $individualRepo->createQueryBuilder('i')
                        ->where('i.forename LIKE :data_like')
                        ->orWhere('i.id2 = :data_int')
                        ->orWhere('i.lastname LIKE :data_like')
                        ->orWhere('i.maidenname LIKE :data_like')
                        ->orWhere('i.phone LIKE :data_like')
                        ->orWhere('i.email LIKE :data_like')
                        ->orWhere('i.address LIKE :data_like')
                        ->orWhere('i.postcode LIKE :data_like')
                        ->orWhere('i.nin LIKE :data_like')
                        ->orWhere('i.utr LIKE :data_like')
                        ->orWhere('i.bankAccountDetails LIKE :data_like')
                        ->orWhere('i.notes LIKE :data_like')
                        ->orWhere('i.archiveNote LIKE :data_like')
                        ->setParameter('data_like', '%' . $string . '%')
                        ->setParameter('data_int', (int) $string)
                        ->getQuery();
                $individuals = $query->getResult();
                $businessRepo = $em->getRepository('AppBundle:Business');
                $query = $businessRepo->createQueryBuilder('b')
                        ->where('b.id2 = :data_int')
                        ->orWhere('b.name LIKE :data_like')
                        ->orWhere('b.cno LIKE :data_like')
                        ->orWhere('b.telephone LIKE :data_like')
                        ->orWhere('b.email LIKE :data_like')
                        ->orWhere('b.address LIKE :data_like')
                        ->orWhere('b.postcode LIKE :data_like')
                        ->orWhere('b.utr LIKE :data_like')
                        ->orWhere('b.vat LIKE :data_like')
                        ->orWhere('b.epaye LIKE :data_like')
                        ->orWhere('b.accoff LIKE :data_like')
                        ->orWhere('b.accountsOffice LIKE :data_like')
                        ->orWhere('b.notes LIKE :data_like')
                        ->orWhere('b.archiveNote LIKE :data_like')
                        ->setParameter('data_like', '%' . $string . '%')
                        ->setParameter('data_int', (int) $string)
                        ->getQuery();
                $businesses = $query->getResult();
            }
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'form' => $form->createView(),
                    'individuals' => $individuals,
                    'businesses' => $businesses,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/search/advanced",name="advanced-search")
     */
    public function advancedSearchAction(Request $request) {
        $individuals = [];
        $business = [];
        return $this->render('default/advanced_search.html.twig', [
                    'business' => $business,
                    'individuals' => $individuals,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/search/expired-ids",name="expired-ids")
     */
    public function expiredIdsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//        $repoFiles = $em->getRepository('AppBundle:File');
//
//        $query = $repoFiles->createQueryBuilder('f')
//                ->join('AppBundle:FileType', 't')
//                ->where('t.name = :type')
//                ->setParameter('type', 'ID')
//                ->andWhere('f.date > :date')
//                ->setParameter('date', new \DateTime())
//                ->getQuery();
//        $files = $query->getResult();
//        $ids = [];
        $repoFiles = $em->getRepository('AppBundle:File');
        $repoFileType = $em->getRepository('AppBundle:FileType');
        $fileType = $repoFileType->findOneByName('ID');
        $qq = $repoFiles->createQueryBuilder('f')
                ->where('f.type = :type')
                ->setParameter('type', $fileType)
                ->andWhere('f.date > :date')
                ->setParameter('date', new \DateTime())
                ->getQuery();
        $files = $qq->getResult();
        $ids = [0];
        foreach ($files as $file) {
            if (!empty($file->getIndividual())) {
                $ids[] = $file->getIndividual()->getId();
            }
        }
        foreach ($files as $file) {
            foreach ($files as $file) {
                if (!empty($file->getIndividual)) {
                    $ids[] = $file->getIndividual()->getId();
                }
            }
        }
        $repoIndividual = $em->getRepository('AppBundle:Individual');
        $query = $repoIndividual->createQueryBuilder('i')
                ->where('NOT i.id IN (:ids)')
                ->setParameter('ids', $ids)
                ->getQuery();
        $individuals = $query->getResult();
        return $this->render('default/expired_ids.html.twig', [
                    'individuals' => $individuals,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/individual/edit-address-history/{id}", name="edit-address-history")
     */
    public function editAddressHistoryAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $historyRepo = $em->getRepository('AppBundle:AddressHistory');
        $address = $historyRepo->find($id);
        $individual = $address->getIndividual();
        $business = $address->getBusiness();
        $form = $this->createForm(AddressHistoryType::class, $address);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setIndividual($individual);
            $data->setBusiness($business);
            $em->persist($address);
            $em->flush();
            if (!empty($individual)) {
                return $this->redirectToRoute('app_individual_show', ['id' => $individual->getId()]);
            } elseif (!empty($business)) {
                return $this->redirectToRoute('app_business_show', ['id' => $business->getId()]);
            }
        }
        return $this->render('default/edit_address_history.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/individual/delete-address-history/{id}", name="delete-address-history")
     */
    public function deleteAddressHistoryAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:AddressHistory');
        $address = $repo->find($id);
        $individual = $address->getIndividual();
        $business = $address->getBusiness();
        $em->remove($address);
        $em->flush();
        if (!empty($individual)) {
            return $this->redirectToRoute('app_individual_show', ['id' => $individual->getId()]);
        } elseif (!empty($business)) {
            return $this->redirectToRoute('app_business_show', ['id' => $business->getId()]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/file/delete/{id}",name="file-delete")
     */
    public function deleteFileAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:File');
        $file = $repo->find($id);
        unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $file->getPath() . '/' . $file->getFileName());
        $individual = $file->getIndividual();
        $business = $file->getBusiness();
        $em->remove($file);
        $em->flush();
        if (!empty($individual)) {
            return $this->redirectToRoute('app_individual_show', ['id' => $individual->getId()]);
        } elseif (!empty($business)) {
            return $this->redirectToRoute('app_business_show', ['id' => $business->getId()]);
        }
    }

}
