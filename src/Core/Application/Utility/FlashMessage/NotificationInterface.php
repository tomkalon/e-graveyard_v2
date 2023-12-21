<?php

namespace App\Core\Application\Utility\FlashMessage;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Domain\Utility\FlashMessage\FlashMessageInterface;

interface NotificationInterface extends FlashMessageInterface
{
    public function addNotification(string $name, NotificationDto $dto): void;
}
