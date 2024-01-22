<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Utility\FlashMessage\RemoveEntity\RemoveEntityFlashInterface;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\EventListener\Doctrine\PostRemoveListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class RemoveEntityEvent extends PostRemoveListener
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly RemoveEntityFlashInterface $flash
    ) {
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->flash->handleNotification($entity);

        // remove orphans images
        if ($entity instanceof Grave) {
            $main_image = $entity->getMainImage();
            $images = $entity->getImages()->toArray();

            $this->em->remove($main_image);
            foreach ($images as $image) {
                $this->em->remove($image);
            }
        }
    }
}
