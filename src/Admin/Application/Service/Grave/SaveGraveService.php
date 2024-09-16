<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveView;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;
use Ramsey\Uuid\Exception\InvalidArgumentException;

readonly class SaveGraveService implements SaveGraveServiceInterface
{
    public function __construct(
        private GraveRepositoryInterface $graveRepository,
        private EntityManagerInterface   $em,
        private NotificationInterface    $notification,
    ) {}

    /**
     * @throws Exception
     */
    public function persist(GraveView $graveView): void
    {
        // handling save setting
        if (!$graveView->getId()) {
            if ($graveView->isNewAllowed()) {
                $grave = new Grave();
            } else {
                throw new Exception('Creating a new entity is prohibited!');
            }
        } else {
            try {
                $grave = $this->graveRepository->find($graveView->getId());
                if (!$grave) {
                    if ($graveView->isNewAllowed()) {
                        $grave = new Grave();
                        $grave->setId($graveView->getId());
                    } else {
                        throw new EntityNotFoundException('Creating a new entity is prohibited!');
                    }
                }
            } catch (Exception) {
                throw new InvalidArgumentException('Invalid ID format');
            }
        }

        $grave->setGraveyard($graveView->getGraveyard());
        $grave->setSector($graveView->getSector());
        if ($graveView->getRow()) {
            $grave->setRow($graveView->getRow());
        }
        $grave->setNumber($graveView->getNumber());

        if ($graveView->getCoordinates()) {
            $coordinates = explode(', ', $graveView->getCoordinates());
            $grave->setPositionX($coordinates[1]);
            $grave->setPositionY($coordinates[0]);
        } else {
            if ($graveView->getPositionX()) {
                $grave->setPositionX($graveView->getPositionX());
            }
            if ($graveView->getPositionY()) {
                $grave->setPositionY($graveView->getPositionY());
            }
        }
        if ($graveView->getMainImage()) {
            $grave->setMainImage($graveView->getMainImage());
        }


        if ($graveView->getImages()) {
            foreach ($graveView->getImages() as $image) {
                if (!$grave->getImages()->contains($image)) {
                    $grave->addImages($image);
                }
            }
        }

        if (!$this->em->contains($grave)) {
            $this->em->persist($grave);
        } else {
            // set main image
            if (!$grave->getMainImage()) {
                $images = $grave->getImages();
                if ($images->count()) {
                    $grave->setMainImage($images->first());
                }
            }

            // checks whether the entity is different from the one already saved in the database.
            $uow = $this->em->getUnitOfWork();
            $uow->computeChangeSets();
            $changeSet = $uow->getEntityChangeSet($grave);

            $imageChangeSet = null;
            foreach ($grave->getImages() as $image) {
                if ($uow->getEntityChangeSet($image)) {
                    $imageChangeSet = $uow->getEntityChangeSet($image);
                }
            }

            if (empty($changeSet) and empty($imageChangeSet)) {
                // no changes notification
                $this->notification->addNotification('notification', new NotificationDto(
                    'notification.grave.update.label',
                    NotificationTypeEnum::INFO,
                    'notification.lifecycle.no_changes',
                ));
            } else {
                $this->em->persist($grave);
            }
        }
    }
}
