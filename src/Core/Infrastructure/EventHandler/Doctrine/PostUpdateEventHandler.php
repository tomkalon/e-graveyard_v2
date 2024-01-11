<?php

namespace App\Core\Infrastructure\EventHandler\Doctrine;

use App\Core\Domain\Event\Doctrine\PostUpdateListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PostUpdateEventHandler extends PostUpdateListener
{
    public function __construct(
    )
    {
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
    }
}
