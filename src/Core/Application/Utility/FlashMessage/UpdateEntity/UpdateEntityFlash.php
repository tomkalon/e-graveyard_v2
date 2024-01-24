<?php

namespace App\Core\Application\Utility\FlashMessage\UpdateEntity;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\NotificationTypeEnum;

use Symfony\Contracts\Translation\TranslatorInterface;

class UpdateEntityFlash implements UpdateEntityFlashInterface
{
    public function __construct(
        private readonly TranslatorInterface   $translator,
        private readonly NotificationInterface $flashMessage,
    ) {
    }

    public function handleNotification(object $entity): void
    {
        $title = match (true) {
            $entity instanceof Grave => $this->translator->trans(
                'notification.grave.update.label',
                [], 'flash'
            ),
            $entity instanceof Graveyard => $this->translator->trans(
                'notification.graveyard.create.label',
                [], 'flash'
            ),
            $entity instanceof User => $this->translator->trans(
                'notification.user.create.label',
                [], 'flash'
            ),
            default => $this->translator->trans('notification.lifecycle.create.label', [], 'flash'),
        };

        $content = $this->translator->trans('notification.lifecycle.update.success', [], 'flash');


        if (!$entity instanceof FileGrave) {
            $this->flashMessage->addNotification('notification', new NotificationDto(
                $title,
                NotificationTypeEnum::SUCCESS,
                $content
            ));
        }
    }
}
