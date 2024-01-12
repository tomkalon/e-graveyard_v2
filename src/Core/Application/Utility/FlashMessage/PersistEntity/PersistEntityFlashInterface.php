<?php

namespace App\Core\Application\Utility\FlashMessage\PersistEntity;

interface PersistEntityFlashInterface
{
    public function handleNotification(object $entity): void;
}
