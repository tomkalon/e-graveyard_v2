<?php

namespace App\Core\Application\DTO\FlashMessage;

use App\Core\Domain\Enum\NotificationTypeEnum;

class NotificationDto
{
    public string $title;
    public NotificationTypeEnum $type;
    public string $content;
    public ?string $time;

    public function __construct(
        string $title,
        NotificationTypeEnum $type,
        string $content,
        ?string $time = null,
    ) {
        $this->title = $title;
        $this->type = $type;
        $this->content = $content;
        $this->time = $time;
    }
}
