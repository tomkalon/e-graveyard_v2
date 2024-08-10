<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Service\File\RemoveFileServiceInterface;
use App\Core\Application\Utility\FlashMessage\RemoveEntity\RemoveEntityFlashInterface;
use App\Core\Domain\Entity\File;
use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\EventListener\Doctrine\PostRemoveListener;
use App\Core\Infrastructure\Logger\Doctrine\RemoveEntityLogger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class RemoveEntityEvent extends PostRemoveListener
{
    public function __construct(
        private readonly EntityManagerInterface     $em,
        private readonly RemoveEntityFlashInterface $flash,
        private readonly RemoveFileServiceInterface $removeFileService,
        private readonly RemoveEntityLogger         $entityLogger,
        private readonly string                     $targetDirectory,
        private readonly string                     $targetThumbnailDirectory
    ) {
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $removedEntity = $args->getObject();

        // remove orphans images
        if ($removedEntity instanceof Grave) {
            $images = $removedEntity->getImages();

            /** @var FileGrave $image */
            foreach ($images as $image) {
                $this->em->remove($image);
                $this->removeFileService->remove($image, $this->targetDirectory, $this->targetThumbnailDirectory);
            }
            $this->em->flush();
        }

        if ($removedEntity instanceof File) {
            $this->removeFileService->remove($removedEntity, $this->targetDirectory, $this->targetThumbnailDirectory);
        }

        $this->entityLogger->logEvent($removedEntity);
        $this->flash->handleNotification($removedEntity);
    }
}
