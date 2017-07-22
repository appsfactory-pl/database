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

}
