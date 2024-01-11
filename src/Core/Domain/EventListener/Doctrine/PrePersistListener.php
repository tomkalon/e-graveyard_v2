<?php

namespace App\Core\Domain\EventListener\Doctrine;

use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PrePersistListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist => 'prePersist'
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
    }
}
