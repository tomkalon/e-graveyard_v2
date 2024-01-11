<?php

namespace App\Core\Domain\Event\Doctrine;

use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PreUpdateListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate => 'preUpdate'
        ];
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
    }
}
