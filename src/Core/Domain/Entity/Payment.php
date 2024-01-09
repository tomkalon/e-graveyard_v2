<?php

namespace App\Core\Domain\Entity;

use App\Core\Domain\Enum\CurrencyTypeEnum;
use App\Core\Domain\Trait\IdTrait;
use App\Core\Domain\Trait\LifecycleTrait;
use DateTimeImmutable;

class Payment
{
    use IdTrait;
    use LifecycleTrait;

    private int $value;
    private CurrencyTypeEnum $currency;
    private ?string $description;
    private ?DateTimeImmutable $validity_time;

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getCurrency(): CurrencyTypeEnum
    {
        return $this->currency;
    }

    public function setCurrency(CurrencyTypeEnum $currency): void
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

    public function getValidityTime(): ?DateTimeImmutable
    {
        return $this->validity_time;
    }

    public function setValidityTime(?DateTimeImmutable $validity_time): void
    {
        $this->validity_time = $validity_time;
    }
}
