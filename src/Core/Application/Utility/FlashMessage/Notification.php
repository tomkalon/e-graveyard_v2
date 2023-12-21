<?php

namespace App\Core\Application\Utility\FlashMessage;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use Symfony\Component\HttpFoundation\Session\Session;

class Notification implements NotificationInterface
{

    public function addNotification(string $name, NotificationDto $dto): void
    {
        $session = new Session();
        $session->getFlashBag()->add($name, array(
            'title' => $dto->title,
            'type' => $dto->type->value,
            'content' => $dto->content,
            'time' => $dto->time
        ));
    }
}
