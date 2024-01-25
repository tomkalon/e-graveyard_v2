<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Utility\FlashMessage\PersistEntity\PersistEntityFlashInterface;
use App\Core\Domain\EventListener\Doctrine\PostPersistListener;
use App\Core\Infrastructure\Logger\Doctrine\EntityLoggerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PersistEntityEvent extends PostPersistListener
{
    public function __construct(
        private readonly PersistEntityFlashInterface $flash,
        private readonly EntityLoggerInterface $entityLogger,
    ) {
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $persistedEntity = $args->getObject();
        $this->entityLogger->logEvent($persistedEntity);
        $this->flash->handleNotification($persistedEntity);
    }
}
