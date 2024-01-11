<?php

namespace App\Core\Application\Utility\FlashMessage;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Domain\Utility\FlashMessage\FlashMessageInterface;

class Notification implements NotificationInterface
{
    public function __construct(
        private readonly FlashMessageInterface $flashMessage
    ) {
    }

    public function addNotification(string $name, NotificationDto $dto): void
    {
        $this->flashMessage->add($name, array(
            'title' => $dto->title,
            'type' => $dto->type->value,
            'content' => $dto->content,
            'time' => $dto->time
        ));
    }
}
