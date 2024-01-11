<?php

namespace App\Core\Domain\Enum;

enum PaymentStatusEnum: string
{
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case SOON = 'soon';
    case EXPIRED = 'expired';
}
