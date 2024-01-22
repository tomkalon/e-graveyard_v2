<?php

namespace App\Core\Application\Utility\FlashMessage\RemoveEntity;

interface RemoveEntityFlashInterface
{
    public function handleNotification(object $entity): void;
}
