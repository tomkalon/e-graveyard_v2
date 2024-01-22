<?php

namespace App\Core\Application\Utility\FlashMessage\RemoveEntity;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\File;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\Person;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Symfony\Contracts\Translation\TranslatorInterface;

class RemoveEntityFlash implements RemoveEntityFlashInterface
{

    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly NotificationInterface $flashMessage,
    ) {
    }

    public function handleNotification(object $entity): void
    {
        $title = match (true) {
            $entity instanceof Grave => $this->translator->trans('notification.entity.grave', [], 'flash'),
            $entity instanceof Graveyard => $this->translator->trans('notification.entity.graveyard', [], 'flash'),
            $entity instanceof User => $this->translator->trans('notification.entity.user', [], 'flash'),
            $entity instanceof File => $this->translator->trans('notification.file.name', [], 'flash'),
            $entity instanceof Person => $this->translator->trans('notification.entity.person', [], 'flash'),
            default => $this->translator->trans('notification.lifecycle.remove.title', [], 'flash'),
        };

        $this->flashMessage->addNotification('notification', new NotificationDto(
            $title,
            NotificationTypeEnum::SUCCESS,
            $this->translator->trans('notification.lifecycle.remove.content', [], 'flash')
        ));
    }
}
