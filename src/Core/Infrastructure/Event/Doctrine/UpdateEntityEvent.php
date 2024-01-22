<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Utility\FlashMessage\UpdateEntity\UpdateEntityFlashInterface;
use App\Core\Domain\EventListener\Doctrine\PostUpdateListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UpdateEntityEvent extends PostUpdateListener
{
    public function __construct(
        private readonly UpdateEntityFlashInterface $flash
    ) {
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->flash->handleNotification($entity);
    }
}
