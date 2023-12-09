<?php

namespace App\Core\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class LoginSuccessListener implements EventSubscriberInterface
{

    public function __construct(private readonly TokenStorageInterface $tokenStorage)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationEvents::AUTHENTICATION_SUCCESS => 'onLoginSuccess',
        ];
    }

    public function onLoginSuccess(AuthenticationEvent $event): void
    {

    }
}
