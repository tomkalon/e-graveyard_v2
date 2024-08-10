<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\View\Payment;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Enum\CurrencyTypeEnum;
use DateTimeImmutable;
use Exception;

class PaymentGraveView
{
    private ?int $value;
    private ?CurrencyTypeEnum $currency;
    private ?string $description;
    private ?Grave $grave;
    private ?DateTimeImmutable $validity_time;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

    public function __construct(
        ?int $value = null,
        ?CurrencyTypeEnum $currency = null,
        ?string $description = null,
        ?Grave $grave = null,
        ?DateTimeImmutable $validity_time = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null,
    ) {
        $this->value = $value;
        $this->currency = $currency;
        $this->description = $description;
        $this->grave = $grave;
        $this->validity_time = $validity_time;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    /**
     * @throws Exception
     */
    public static function fromEntity(PaymentGrave $paymentGrave): self
    {
        return new self(
            $paymentGrave->getValue(),
            $paymentGrave->getCurrency(),
            $paymentGrave->getDescription(),
            $paymentGrave->getGrave(),
            $paymentGrave->getValidityTime(),
            $paymentGrave->getUpdatedAt(),
            $paymentGrave->getCreatedAt(),
        );
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): void
    {
        $this->value = $value;
    }

    public function getCurrency(): ?CurrencyTypeEnum
    {
        return $this->currency;
    }

    public function setCurrency(?CurrencyTypeEnum $currency): void
    {
        $this->currency = $currency;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getGrave(): ?Grave
    {
        return $this->grave;
    }

    public function setGrave(?Grave $grave): void
    {
        $this->grave = $grave;
    }

    public function getValidityTime(): ?DateTimeImmutable
    {
        return $this->validity_time;
    }

    public function setValidityTime(?DateTimeImmutable $validity_time): void
    {
        $this->validity_time = $validity_time;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
