<?php

namespace App\Core\Application\Utility\FlashMessage\RemoveEntity;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\File;
use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\PaymentGrave;
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
            $entity instanceof Grave => $this->translator->trans(
                'notification.grave.remove.label',
                [], 'flash'
            ),
            $entity instanceof Graveyard => $this->translator->trans(
                'notification.graveyard.remove.label',
                [], 'flash'
            ),
            $entity instanceof User => $this->translator->trans(
                'notification.user.remove.label',
                [], 'flash'
            ),
            $entity instanceof File => $this->translator->trans(
                'notification.file.remove.label',
                [], 'flash'
            ),
            $entity instanceof Person => $this->translator->trans(
                'notification.person.create.label',
                [], 'flash'
            ),
            default => $this->translator->trans('notification.lifecycle.remove.title', [], 'flash'),
        };


        $content = match (true) {
            $entity instanceof Grave => $this->translator->trans(
                'notification.grave.remove.success',
                [], 'flash'
            ),
            $entity instanceof Graveyard => $this->translator->trans(
                'notification.graveyard.remove.success',
                [
                    '%graveyard%' =>$entity->getName()
                ],
                'flash'
            ),
            $entity instanceof Person => $this->translator->trans(
                'notification.person.remove.success',
                [
                    '%firstname%' =>$entity->getFirstname(),
                    '%lastname%' =>$entity->getLastname(),
                ],
                'flash'
            ),
            $entity instanceof PaymentGrave => $this->translator->trans(
                'notification.paymentGrave.remove.success',
                [
                    '%payment%' =>$entity->getMoney(),
                    '%currency%' =>$entity->getCurrency()->trans($this->translator),
                ],
                'flash'
            ),
            $entity instanceof FileGrave, $entity instanceof File => $this->translator->trans(
                'notification.file.remove.success',
                [
                    '%name%' =>$entity->getFilename(),
                ],
                'flash'
            ),
            default => $this->translator->trans('notification.lifecycle.remove.success', [], 'flash')
        };

        $this->flashMessage->addNotification('notification', new NotificationDto(
            $title,
            NotificationTypeEnum::SUCCESS,
            $content
        ));
    }
}
