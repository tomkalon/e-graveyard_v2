<?php

namespace App\Core\Application\Utility\FlashMessage;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Domain\Utility\FlashMessage\FlashMessageInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class Notification implements NotificationInterface
{
    public function __construct(
        private readonly FlashMessageInterface $flashMessage,
        private readonly TranslatorInterface $translator
    ) {
    }

    public function addNotification(string $name, NotificationDto $dto): void
    {
        $this->flashMessage->add($name, array(
            'title' => $this->translator->trans($dto->title, [], 'flash'),
            'type' => $dto->type->value,
            'content' => $this->translator->trans($dto->content, [], 'flash'),
            'time' => $dto->time
        ));
    }
}
