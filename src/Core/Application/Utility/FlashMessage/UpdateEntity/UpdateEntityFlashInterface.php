<?php

namespace App\Core\Application\Utility\FlashMessage\UpdateEntity;

interface UpdateEntityFlashInterface
{
    public function handleNotification(object $entity): void;
}
