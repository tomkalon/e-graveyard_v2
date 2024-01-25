<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Utility\FlashMessage\UpdateEntity\UpdateEntityFlashInterface;
use App\Core\Domain\EventListener\Doctrine\PostUpdateListener;
use App\Core\Infrastructure\Logger\Doctrine\EntityLoggerInterface;
use App\Core\Infrastructure\Logger\Doctrine\UpdateLoggerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class UpdateEntityEvent extends PostUpdateListener
{
    public function __construct(
        private readonly UpdateEntityFlashInterface $flash,
        private readonly EntityLoggerInterface      $entityLogger,
    ) {
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $updatedEntity = $args->getObject();
        $this->entityLogger->logEvent($updatedEntity);
        $this->flash->handleNotification($updatedEntity);
    }
}
