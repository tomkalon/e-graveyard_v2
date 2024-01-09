<?php

namespace App\Admin\Application\Dto\Payment;

use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Enum\CurrencyTypeEnum;
use DateTimeImmutable;

class PaymentGraveDto
{
    public ?int $value;
    public ?CurrencyTypeEnum $currency;
    public ?string $description;
    public ?DateTimeImmutable $validity_time;

    public function __construct(
        ?string $value = null,
        ?CurrencyTypeEnum $currency = null,
        ?string $description = null,
        ?DateTimeImmutable $validity_time = null
    ) {
        $this->value = $value;
        $this->currency = $currency;
        $this->description = $description;
        $this->validity_time = $validity_time;
    }

    public static function fromEntity(PaymentGrave $paymentGrave): self
    {
        return new self(
            $paymentGrave->getValue(),
            $paymentGrave->getCurrency(),
            $paymentGrave->getDescription(),
            $paymentGrave->getValidityTime(),
        );
    }
}
