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
        if (empty($this->getUser())){
            return $this->redirectToRoute('fos_user_security_login');
        }
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $d = $form->getData();
            $string = $d['string'];
            if(strlen($string)>2){
                $individualRepo = $em->getRepository('AppBundle:Individual');
                $query = $individualRepo->createQueryBuilder('i')
//                    ->where('i.id2 = "'.$string.'"')
                    ->where('i.forename = "jhdsbhugs"')
            //                $query = $em->createQuery(
//                    'SELECT i
//                    FROM AppBundle:Individual
//                    WHERE i.id2 = :d
//                    '
//                )
//                    ->setParameter('d',$string)
                    ->getQuery()
                ;
//                var_dump($query);
                $individuals = $query->getResult();
            }
//            $businessRepo = $em->getRepository('AppBundle:Business');
//            var_dump($d);
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }
}
