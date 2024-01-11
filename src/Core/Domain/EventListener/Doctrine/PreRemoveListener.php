<?php

namespace App\Core\Domain\EventListener\Doctrine;

use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PreRemoveListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::preRemove => 'preRemove'
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
    }
}
