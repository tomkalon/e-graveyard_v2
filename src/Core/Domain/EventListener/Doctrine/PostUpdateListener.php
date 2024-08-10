<?php

namespace App\Core\Domain\EventListener\Doctrine;

use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostUpdateListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::postUpdate => 'postUpdate',
        ];
    }

    public function postUpdate(LifecycleEventArgs $args) {}
}
