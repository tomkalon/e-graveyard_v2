<?php

namespace App\Core\Infrastructure\EventHandler\User;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\Event\LoginSuccessListener;
use App\Core\Domain\Utility\FlashMessage\FlashMessageInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class OnLoginNotification extends LoginSuccessListener
{
    public function __construct(
        TokenStorageInterface $tokenStorage,
        private readonly FlashMessageInterface $flashMessage
    )
    {
        parent::__construct($tokenStorage);
    }

    public function onLoginSuccess(AuthenticationEvent $event): void
    {
        $this->flashMessage->addNotification('notification', new NotificationDto(
            'notification.user.login.title',
            NotificationTypeEnum::SUCCESS,
            'notification.user.login.content'
        ));
    }
}


