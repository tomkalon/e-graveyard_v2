<?php

namespace App\Core\Domain\EventListener\Doctrine;

use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostPersistListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::postPersist => 'postPersist',
        ];
    }

    public function postPersist(LifecycleEventArgs $args) {}
}
