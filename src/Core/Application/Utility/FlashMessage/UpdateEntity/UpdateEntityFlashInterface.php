<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\Utility\FlashMessage\UpdateEntity;

interface UpdateEntityFlashInterface
{
    public function handleNotification(object $entity): void;
}
