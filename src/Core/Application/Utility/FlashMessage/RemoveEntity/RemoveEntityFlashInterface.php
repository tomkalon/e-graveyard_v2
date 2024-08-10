<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\Utility\FlashMessage\RemoveEntity;

interface RemoveEntityFlashInterface
{
    public function handleNotification(object $entity): void;
}
