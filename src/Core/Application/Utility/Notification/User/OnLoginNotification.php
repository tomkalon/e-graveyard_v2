<?php

namespace App\Core\Application\Utility\Notification\User;

use App\Core\Domain\Event\LoginSuccessListener;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class OnLoginNotification extends LoginSuccessListener
{
    public function onLoginSuccess(AuthenticationEvent $event): void
    {
        // FLASH MESSAGES
        $session = new Session();
        $session->getFlashBag()->add('message', array(
            'title' => 'Logowanie',
            'content' => 'Pomyślnie zalogowano'
        ));
    }
}


