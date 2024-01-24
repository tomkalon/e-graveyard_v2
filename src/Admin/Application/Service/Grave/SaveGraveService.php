<?php

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
use Symfony\Contracts\Translation\TranslatorInterface;

class SaveGraveService implements SaveGraveServiceInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly EntityManagerInterface   $em,
        private readonly NotificationInterface    $notification,
        private readonly TranslatorInterface      $translator,
    ) {
    }

    public function persist(GraveView $graveView): void
    {

        if (!$graveView->getId()) {
            $grave = new Grave();
        } else {
            try {
                $grave = $this->graveRepository->find($graveView->getId());
                if (!$grave) {
                    throw new EntityNotFoundException();
                }
            } catch (Exception $e) {
                throw new InvalidArgumentException($e->getMessage());
            }
        }

        $grave->setGraveyard($graveView->getGraveyard());
        $grave->setSector($graveView->getSector());
        if ($graveView->getRow()) {
            $grave->setRow($graveView->getRow());
        }
        $grave->setNumber($graveView->getNumber());
        if ($graveView->getPositionX()) {
            $grave->setPositionX($graveView->getPositionX());
        }
        if ($graveView->getPositionY()) {
            $grave->setPositionY($graveView->getPositionY());
        }
        if ($graveView->getPositionY()) {
            $grave->setPositionY($graveView->getPositionY());
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
                    $this->translator->trans('notification.grave.update.label', [], 'flash'),
                    NotificationTypeEnum::INFO,
                    $this->translator->trans('notification.grave.no_changes', [], 'flash')
                ));
            } else {
                $this->em->persist($grave);
            }
        }
    }
}
