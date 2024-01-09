<?php

namespace App\Admin\Application\Dto\Payment;

use App\Core\Domain\Enum\CurrencyTypeEnum;
use DateTimeImmutable;

class PaymentGraveDto
{
    public ?int $value;
    public CurrencyTypeEnum $currency;
    public ?string $description;
    public ?DateTimeImmutable $validity_time;
}
