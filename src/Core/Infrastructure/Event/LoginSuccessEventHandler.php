<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Event;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\EventListener\LoginSuccessListener;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

class LoginSuccessEventHandler extends LoginSuccessListener
{
    public function __construct(
        TokenStorageInterface $tokenStorage,
        private readonly TranslatorInterface $translator,
        private readonly NotificationInterface $flashMessage,
    ) {
        parent::__construct($tokenStorage);
    }

    public function onLoginSuccess(AuthenticationEvent $event): void
    {
        $this->flashMessage->addNotification('notification', new NotificationDto(
            $this->translator->trans('notification.user.login.title', [], 'flash'),
            NotificationTypeEnum::SUCCESS,
            $this->translator->trans('notification.user.login.success.content', [], 'flash'),
        ));
    }
}
