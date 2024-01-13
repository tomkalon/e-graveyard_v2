<?php

namespace App\Admin\Application\Dto\Payment;

use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Enum\CurrencyTypeEnum;
use DateTimeImmutable;

class PaymentGraveDto
{
    public ?int $value;
    public ?string $currency;
    public ?string $description;
    public ?string $validity_time;
    public ?string $grave;

    public function __construct(
        ?string $value = null,
        ?string $currency = null,
        ?string $description = null,
        ?string $validity_time = null,
        ?string $grave = null,
    ) {
        $this->value = $value / 100;
        $this->currency = $currency;
        $this->description = $description;
        $this->validity_time = $validity_time;
        $this->grave = $grave;
    }

    public static function fromEntity(PaymentGrave $paymentGrave): self
    {
        return new self(
            $paymentGrave->getValue(),
            $paymentGrave->getCurrency()->value,
            $paymentGrave->getDescription(),
            $paymentGrave->getValidityTime()->format('Y-m-d'),
            $paymentGrave->getGrave()->getId(),
        );
    }
}
