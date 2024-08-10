<?php

namespace App\Core\Domain\Enum;

enum NotificationTypeEnum: string
{
    case INFO = 'info';
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case WARNING = 'warning';
}
