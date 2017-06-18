<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\UserType;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller {

    /**
     * @Route("/user/add")
     */
    public function addAction(Request $request) {
        /** @var $formFactory FactoryInterface */
//        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

//        $form = $formFactory->createForm();
        $form = $this->createForm(UserType::class, $user);
//        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
//                    $url = $this->generateUrl('fos_user_registration_confirmed');
//                    $response = new RedirectResponse($url);
                    return $this->redirectToRoute('app_user_list');
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }
        return $this->render('AppBundle:User:add.html.twig', array(
                    'form' => $form->createView(),
                        // ...
        ));
    }

    /**
     * @Route("/user/list")
     */
    public function listAction(EntityManagerInterface $em) {
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('AppBundle:User:list.html.twig', array(
                    'users' => $users,
        ));
    }

    /**
     * @Route("/user/edit/{id}", requirements={"id" = "\d+"})
     */
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('AppBundle:User');
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
//        var_dump($form->isSubmitted(),$form->isValid()); die;
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setEnabled($form->get('enabled')->getData());
            $password = $form->get('plainPassword')->getData();
            if (!empty($password)) {
                $user->setPlainPassword($password);
            }

            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            return $this->redirectToRoute('app_user_list');
        }
        return $this->render('AppBundle:User:edit.html.twig', array(
                    'form' => $form->createView(),
                        // ...
        ));
    }

    /**
     * @Route("/user/activate/{id}", requirements={"id" = "\d+"})
     */
    public function activateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $user_repository = $em->getRepository('AppBundle:User');
        $user = $user_repository->find($id);
        if (!empty($user)) {
            $user->setEnabled(true);
            $em->persist($user);
            $em->flush();
        }
        return $this->redirectToRoute('app_user_list');
    }

    /**
     * @Route("/user/delete/{id}", requirements={"id" = "\d+"})
     */
    public function deleteAction(Request $request, $id) {
//        echo $id; die;
//        $token=null;
        $em = $this->getDoctrine()->getManager();
        $user_repository = $em->getRepository('AppBundle:User');
//        $userManager = $this->get('fos_user.user_manager');

        $user = $user_repository->find($id);
        if (!empty($user)) {
            $user->setEnabled(false);
            $em->persist($user);
            $em->flush();
        }
        return $this->redirectToRoute('app_user_list');

        return $this->render('AppBundle:User:delete.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/user")
     */
    public function indexAction() {
        return $this->render('AppBundle:User:index.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/user/show-log")
     */
    public function showLogAction(EntityManagerInterface $em) {
        $events = $em->getRepository('AppBundle:UserLog')->createQueryBuilder('u')->orderBy('u.loginDate','DESC')->getQuery()->getResult();
        return $this->render('AppBundle:User:show-log.html.twig', array(
                    'events' => $events,
        ));
    }

}
