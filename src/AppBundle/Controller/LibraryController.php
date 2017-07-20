<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;

class LibraryController extends Controller
{
    /**
     * @Route("/library/maritial-status")
     */
    public function maritialStatusAction(EntityManagerInterface $em)
    {
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
    public function maritialStatusAddAction()
    {
        return $this->render('AppBundle:Library:maritial_status_add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/maritial-status-edit/{id}")
     */
    public function maritialStatusEditAction($id)
    {
        return $this->render('AppBundle:Library:maritial_status_edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/file-type")
     */
    public function fileTypeAction()
    {
        return $this->render('AppBundle:Library:file_type.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/file-type-add")
     */
    public function fileTypeAddAction()
    {
        return $this->render('AppBundle:Library:file_type_add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/file-type-edit/{id}")
     */
    public function fileTypeEditAction($id)
    {
        return $this->render('AppBundle:Library:file_type_edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/status")
     */
    public function statusAction()
    {
        return $this->render('AppBundle:Library:status.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/status-add")
     */
    public function statusAddAction()
    {
        return $this->render('AppBundle:Library:status_add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/status-edit/{id}")
     */
    public function statusEditAction($id)
    {
        return $this->render('AppBundle:Library:status_edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/disengegement-reason")
     */
    public function disengegementReasonAction()
    {
        return $this->render('AppBundle:Library:disengegement_reason.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/disengegement-reason-add")
     */
    public function disengegementReasonAddAction()
    {
        return $this->render('AppBundle:Library:disengegement_reason_add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/library/disengegement-reason-edit/{id}")
     */
    public function disengegementReasonEditAction($id)
    {
        return $this->render('AppBundle:Library:disengegement_reason_edit.html.twig', array(
            // ...
        ));
    }

}
