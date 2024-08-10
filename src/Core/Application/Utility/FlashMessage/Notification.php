<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\Utility\FlashMessage;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Domain\Utility\FlashMessage\FlashMessageInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class Notification implements NotificationInterface
{
    public function __construct(
        private FlashMessageInterface $flashMessage,
        private TranslatorInterface   $translator,
    ) {}

    public function addNotification(string $name, NotificationDto $dto): void
    {
        $this->flashMessage->add($name, array(
            'title' => $this->translator->trans($dto->title, [], 'flash'),
            'type' => $dto->type->value,
            'content' => $this->translator->trans($dto->content, [], 'flash'),
            'time' => $dto->time,
        ));
    }
}
