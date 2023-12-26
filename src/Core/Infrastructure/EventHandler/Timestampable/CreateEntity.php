<?php

namespace App\Core\Infrastructure\EventHandler\Timestampable;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\Event\CreatedResponseListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateEntity extends CreatedResponseListener
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly NotificationInterface $flashMessage
    )
    {
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        if ($response->getStatusCode() === 201) {
            $this->flashMessage->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.user.login.title', [], 'flash'),
                NotificationTypeEnum::SUCCESS,
                $this->translator->trans('notification.user.login.success.content', [], 'flash')
            ));
        }
    }
}
