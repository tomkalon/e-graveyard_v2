<?php

namespace App\Admin\Application\Services\Grave;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SaveGraveService implements SaveGraveServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly NotificationInterface $notification,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function persist(Grave $grave): void
    {
        if (!$this->em->contains($grave)) {
            $this->em->persist($grave);
        } else {
            $uow = $this->em->getUnitOfWork();
            $uow->computeChangeSets();
            $changeSet = $uow->getEntityChangeSet($grave);

            if (empty($changeSet)) {
                $this->notification->addNotification('notification', new NotificationDto(
                    $this->translator->trans('notification.entity.grave', [], 'flash'),
                    NotificationTypeEnum::INFO,
                    $this->translator->trans('notification.grave.no_changes', [], 'flash')
                ));
            } else {
                $this->em->persist($grave);
            }
        }
    }
}
