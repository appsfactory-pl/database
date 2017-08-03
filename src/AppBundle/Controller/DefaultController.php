<?php

namespace AppBundle\Controller;

use AppBundle\Form\SearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
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
                    ->setParameter('data_int', (int)$string)
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
                    ->setParameter('data_int', (int)$string)
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
     * @Route("/advanced-search",name="advanced-search")
     */
    public function advancedSearchAction(Request $request){
        return $this->render('default/advanced_search.html.twig',[

        ]);
    }

    /**
     * @param Request $request
     * @Route("/expired-ids",name="expired-ids")
     */
    public function expiredIdsAction(Request $request){
        return $this->render('default/expired_ids.html.twig',[

        ]);
    }

}
