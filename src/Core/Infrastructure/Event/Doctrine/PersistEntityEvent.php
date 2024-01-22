<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Utility\FlashMessage\PersistEntity\PersistEntityFlashInterface;
use App\Core\Domain\EventListener\Doctrine\PostPersistListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PersistEntityEvent extends PostPersistListener
{
    public function __construct(
        private readonly PersistEntityFlashInterface $flash
    ) {
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $this->flash->handleNotification($entity);
    }
}
