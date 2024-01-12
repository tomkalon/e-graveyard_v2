<?php

namespace App\Admin\Application\Dto\Payment;

use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Enum\CurrencyTypeEnum;
use DateTimeImmutable;
use Symfony\Component\Translation\Translator;

class PaymentGraveDto
{
    public ?int $value;
    public ?CurrencyTypeEnum $currency;
    public ?string $description;
    public ?DateTimeImmutable $validity_time;
    public ?string $grave;

    public function __construct(
        ?string $value = null,
        ?CurrencyTypeEnum $currency = null,
        ?string $description = null,
        ?DateTimeImmutable $validity_time = null,
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
            $paymentGrave->getCurrency(),
            $paymentGrave->getDescription(),
            $paymentGrave->getValidityTime(),
            $paymentGrave->getGrave()->getId(),
        );
    }

    public function setGrave(?string $grave): void
    {
        $this->grave = $grave;
    }
}
