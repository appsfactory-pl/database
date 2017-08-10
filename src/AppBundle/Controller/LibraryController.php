<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\MaritialStatusType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\FileTypeType;
use AppBundle\Form\StatusType;
use AppBundle\Form\DisengegementReasonType;
use AppBundle\Form\LegalFormType;

class LibraryController extends Controller {

    /**
     * @Route("/library/maritial-status")
     */
    public function maritialStatusAction(EntityManagerInterface $em) {
        $repository = $em->getRepository('AppBundle:MaritialStatus');
        $statuses = $repository->findAll();
        return $this->render('AppBundle:Library:maritial_status.html.twig', array(
                    // ...
                    'statuses' => $statuses,
        ));
    }

    /**
     * @Route("/library/maritial-status-add")
     */
    public function maritialStatusAddAction(Request $request) {
        $form = $this->createForm(MaritialStatusType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $maritialStatus = $form->getData();
            $em->persist($maritialStatus);
            $em->flush();
            return $this->redirectToRoute('app_library_maritialstatus');
        }
        return $this->render('AppBundle:Library:maritial_status_add.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/library/maritial-status-delete/{id}",name="maritial-status-delete")
     */
    public function maritialStatusDelete(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $statusRepo = $em->getRepository('AppBundle:MaritialStatus');
        $status = $statusRepo->find($id);
        $individualRepo = $em->getRepository('AppBundle:Individual');
        $individual = $individualRepo->findOneByMaritialStatus($status);
        if (!empty($individual)) {
            $this->addFlash('error', 'You can\'t delete this status.');
            return $this->redirectToRoute('app_library_maritialstatus');
        } else {
            $em->remove($status);
            $em->flush();
            $this->addFlash('success', 'Status deleted successfully.');
            return $this->redirectToRoute('app_library_maritialstatus');
        }
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/library/file-type-delete/{id}",name="file_type_delete")
     */
    public function fileTypeDeleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $typeRepo = $em->getRepository('AppBundle:FileType');
        $type = $typeRepo->find($id);
        $fileRepo = $em->getRepository('AppBundle:File');
        $file = $fileRepo->findOneByType($type);
        if (!empty($file)) {
            $this->addFlash('error', 'You can\'t delete this type.');
            return $this->redirectToRoute('app_library_filetype');
        } else {
            $em->remove($type);
            $em->flush();
            $this->addFlash('success', 'Type deleted successfully.');
            return $this->redirectToRoute('app_library_filetype');
        }
    }
    
    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/library/status-delete/{id}",name="status_delete")
     */
    public function statusDeleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $statusRepo = $em->getRepository('AppBundle:Status');
        $status = $statusRepo->find($id);
        $individualRepo = $em->getRepository('AppBundle:Individual');
        $individual = $individualRepo->findOneByStatus($status);
        $businessRepo = $em->getRepository('AppBundle:Business');
        $business = $businessRepo->findOneByStatus($status);
        if (!empty($business) || !empty($individual)){
            $this->addFlash('error', 'You can\'t delete this status');
            return $this->redirectToRoute('app_library_status');
        } else {
            $em->remove($status);
            $em->flush();
            $this->addFlash('success', 'Status successfully deleted.');
            return $this->redirectToRoute('app_library_status');
        }
    }
    
    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/library/legal-form-delete/{id}",name="legal_form_delete")
     */
    public function legalFormDeleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $formRepo = $em->getRepository('AppBundle:LegalForm');
        $legalForm = $formRepo->find($id);
        $businessRepo = $em->getRepository('AppBundle:Business');
        $business = $businessRepo->findOneByLegalForm($legalForm);
        if(!empty($business)){
            $this->addFlash('error', "You can't delete this legal form.");
            return $this->redirectToRoute('app_library_legalform');
        } else {
            $em->remove($legalForm);
            $em->flush();
            $this->addFlash('success', 'Legal form successfully deleted.');
            return $this->redirectToRoute('app_library_legalform');
        }
    }
    
    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/library/disengegement-reason-delete/{id}", name="disengegement_reason_delete")
     */
    public function disengegementReasonDeleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $reasonRepo = $em->getRepository('AppBundle:DisengegementReason');
        $reason = $reasonRepo->find($id);
        $businessRepo = $em->getRepository('AppBundle:Business');
        $business = $businessRepo->findOneByDisengegementReason($reason);
        $individualRepo = $em->getRepository('AppBundle:Individual');
        $individual = $individualRepo->findOneByDisengegementReason($reason);
        if(!empty($business) || !empty($individual)){
            $this->addFlash('error', "You can't delete this reason.");
            return $this->redirectToRoute('app_library_disengegementreason');
        } else {
            $em->remove($reason);
            $em->flush();
            $this->addFlash('success', 'Reason form successfully deleted.');
            return $this->redirectToRoute('app_library_disengegementreason');
        }
        
    }
    
    /**
     * 
     * @param Request $request
     * @param type $id
     * @Route("/library/connection-type-delete/{id}",name="connection_type_delete")
     */
    public function connectionTypeDeleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $typeRepo = $em->getRepository('AppBundle:PersonTypes');
        $type = $typeRepo->find($id);
        $iiRepo = $em->getRepository('AppBundle:IndividualIndividual');
        $ii = $iiRepo->findOneByType($type);
        $biRepo = $em->getRepository('AppBundle:BusinessIndividual');
        $bi = $biRepo->findOneByType($type);
        if(!empty($ii) || !empty($bi)){
            $this->addFlash('error', 'You can\'t delete this connection type.');
            return $this->redirectToRoute('app_individual_types');
        } else {
            $em->remove($type);
            $em->flush();
            $this->addFlash('success', 'Connection type removed successfully.');
            return $this->redirectToRoute('app_individual_types');
        }
    }

    /**
     * @Route("/library/maritial-status-edit/{id}")
     */
    public function maritialStatusEditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:MaritialStatus');
        $status = $repo->find($id);
        if (empty($status)) {
            $this->redirectToRoute('app_library_maritialstatus');
        }
        $form = $this->createForm(MaritialStatusType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $maritialStatus = $form->getData();
            $em->persist($maritialStatus);
            $em->flush();
            return $this->redirectToRoute('app_library_maritialstatus');
        }
        return $this->render('AppBundle:Library:maritial_status_edit.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/file-type")
     */
    public function fileTypeAction(EntityManagerInterface $em) {
        $repo = $em->getRepository('AppBundle:FileType');
        $types = $repo->findAll();
        return $this->render('AppBundle:Library:file_type.html.twig', array(
                    // ...
                    'types' => $types,
        ));
    }

    /**
     * @Route("/library/file-type-add")
     */
    public function fileTypeAddAction(Request $request) {
        $form = $this->createForm(FileTypeType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $fileType = $form->getData();
            $em->persist($fileType);
            $em->flush();
            return $this->redirectToRoute('app_library_filetype');
        }
        return $this->render('AppBundle:Library:file_type_add.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/file-type-edit/{id}")
     */
    public function fileTypeEditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:FileType');
        $type = $repo->find($id);
        if (empty($type)) {
            $this->redirectToRoute('app_library_filetype');
        }
        $form = $this->createForm(FileTypeType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileType = $form->getData();
            $em->persist($fileType);
            $em->flush();
            return $this->redirectToRoute('app_library_filetype');
        }
        return $this->render('AppBundle:Library:file_type_edit.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/status")
     */
    public function statusAction(EntityManagerInterface $em) {
        $repo = $em->getRepository('AppBundle:Status');
        $statuses = $repo->findAll();
        return $this->render('AppBundle:Library:status.html.twig', array(
                    // ...
                    'statuses' => $statuses,
        ));
    }

    /**
     * @Route("/library/status-add")
     */
    public function statusAddAction(Request $request) {
        $form = $this->createForm(StatusType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $status = $form->getData();
            $em->persist($status);
            $em->flush();
            return $this->redirectToRoute('app_library_status');
        }
        return $this->render('AppBundle:Library:status_add.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/status-edit/{id}")
     */
    public function statusEditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Status');
        $status = $repo->find($id);
        if (empty($status)) {
            return $this->redirectToRoute('app_library_status');
        }
        $form = $this->createForm(StatusType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status = $form->getData();
            $em->persist($status);
            $em->flush();
            return $this->redirectToRoute('app_library_status');
        }
        return $this->render('AppBundle:Library:status_edit.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/disengegement-reason")
     */
    public function disengegementReasonAction(EntityManagerInterface $em) {
        $repo = $em->getRepository('AppBundle:DisengegementReason');
        $reasons = $repo->findAll();
        return $this->render('AppBundle:Library:disengegement_reason.html.twig', array(
                    // ...
                    'reasons' => $reasons,
        ));
    }

    /**
     * @Route("/library/disengegement-reason-add")
     */
    public function disengegementReasonAddAction(Request $request) {
        $form = $this->createForm(DisengegementReasonType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reason = $form->getData();
            $em->persist($reason);
            $em->flush();
            return $this->redirectToRoute('app_library_disengegementreason');
        }
        return $this->render('AppBundle:Library:disengegement_reason_add.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/disengegement-reason-edit/{id}")
     */
    public function disengegementReasonEditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:DisengegementReason');
        $reason = $repo->find($id);
        if (empty($reason)) {
            return $this->redirectToRoute('app_library_disengegementreason');
        }
        $form = $this->createForm(DisengegementReasonType::class, $reason);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reason = $form->getData();
            $em->persist($reason);
            $em->flush();
            return $this->redirectToRoute('app_library_disengegementreason');
        }
        return $this->render('AppBundle:Library:disengegement_reason_edit.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/legal-form")
     */
    public function legalFormAction(EntityManagerInterface $em) {
        $repo = $em->getRepository('AppBundle:LegalForm');
        $forms = $repo->findAll();
        return $this->render('AppBundle:Library:legal_form.html.twig', array(
                    // ...
                    'forms' => $forms,
        ));
    }

    /**
     * @Route("/library/legal-form-add")
     */
    public function legalFormAddAction(Request $request) {
        $form = $this->createForm(LegalFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $status = $form->getData();
            $em->persist($status);
            $em->flush();
            return $this->redirectToRoute('app_library_legalform');
        }
        return $this->render('AppBundle:Library:legal_form_add.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/library/legal-form-edit/{id}")
     */
    public function legalFormEditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:LegalForm');
        $status = $repo->find($id);
        if (empty($status)) {
            return $this->redirectToRoute('app_library_legalform');
        }
        $form = $this->createForm(LegalFormType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status = $form->getData();
            $em->persist($status);
            $em->flush();
            return $this->redirectToRoute('app_library_legalform');
        }
        return $this->render('AppBundle:Library:legal_form_edit.html.twig', array(
                    // ...
                    'form' => $form->createView(),
        ));
    }

}
