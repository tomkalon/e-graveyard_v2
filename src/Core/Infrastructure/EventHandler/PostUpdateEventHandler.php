<?php

namespace App\Core\Infrastructure\EventHandler;

use App\Core\Domain\Event\PostUpdateListener;
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
