<?php

namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use AppBundle\Entity\UserLog;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class LoginListener implements EventSubscriberInterface {

    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents() {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onLogin',
        );
    }

    public function onLogin($event) {
        if ($event instanceof InteractiveLoginEvent) {
            $user = $event->getAuthenticationToken()->getUser();
            $em = $this->container->get('doctrine')->getManager();
        }
        $userLog = new UserLog();
        $userLog->setIpAddress($_SERVER['REMOTE_ADDR']);
        $userLog->setUser($user);
        $userLog->setLoginDate(new \DateTime());
        $em->persist($userLog);
        $em->flush();
    }

}
