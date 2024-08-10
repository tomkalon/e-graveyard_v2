<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\Utility\FlashMessage;

use App\Core\Application\DTO\FlashMessage\NotificationDto;

interface NotificationInterface
{
    public function addNotification(string $name, NotificationDto $dto): void;
}
