<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Utility\FlashMessage\RemoveEntity\RemoveEntityFlashInterface;
use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\EventListener\Doctrine\PostRemoveListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Exception;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;

class RemoveEntityEvent extends PostRemoveListener
{
    public function __construct(
        private readonly EntityManagerInterface     $em,
        private readonly RemoveEntityFlashInterface $flash,
        private readonly string                     $targetDirectory,
        private readonly string                     $targetThumbnailDirectory
    ) {
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // remove orphans images
        if ($entity instanceof Grave) {
            $images = $entity->getImages();

            try {
                if ($images->count()) {
                    $filesystem = new Filesystem();
                    $paths = [];
                    $thumbPaths = [];

                    /** @var FileGrave $image */
                    foreach ($images as $image) {
                        $paths[] = $this->targetDirectory . '/' .
                            $image->getName() . '.'. $image->getExtension()->value;
                        $thumbPaths[] = $this->targetThumbnailDirectory . '/' .
                            $image->getName() . '.'. $image->getExtension()->value;
                        $this->em->remove($image);
                    }

                    foreach ($paths as $path) {
                        if ($filesystem->exists($path)) {
                            $filesystem->remove($path);
                        }
                    }

                    foreach ($thumbPaths as $thumbPath) {
                        if ($filesystem->exists($thumbPath)) {
                            $filesystem->remove($thumbPath);
                        }
                    }
                }
            } catch (Exception $e) {
                throw new FileNotFoundException($e->getMessage());
            }
            $this->em->flush();
        }
        $this->flash->handleNotification($entity);
    }
}
