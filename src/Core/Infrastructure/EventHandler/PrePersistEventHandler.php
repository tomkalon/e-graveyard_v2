<?php

namespace App\Core\Infrastructure\EventHandler;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\Event\PrePersistListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Contracts\Translation\TranslatorInterface;

class PrePersistEventHandler extends PrePersistListener
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly NotificationInterface $flashMessage
    )
    {
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $entityManager = $args->getObjectManager();

        dd('test');


        if ($entityManager->contains($entity)) {

        } else {
            $this->flashMessage->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.timestampable.create.title', [], 'flash'),
                NotificationTypeEnum::SUCCESS,
                $this->translator->trans('notification.timestampable.create.content', [], 'flash')
            ));
        }
    }
}
