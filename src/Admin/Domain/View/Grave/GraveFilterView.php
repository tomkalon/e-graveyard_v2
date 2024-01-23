<?php

namespace App\Admin\Domain\View\Grave;

use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Enum\PaymentStatusEnum;

class GraveFilterView
{
    private ?Graveyard $graveyard = null;
    private ?int $sector = null;
    private ?int $row = null;
    private ?int $number = null;
    private ?int $deceased_number = null;
    private ?PaymentStatusEnum $payment_status = null;

    public function getGraveyardName(): ?Graveyard
    {
        return $this->graveyard;
    }

    public function setGraveyardName(?Graveyard $graveyard): void
    {
        $this->graveyard = $graveyard;
    }

    public function getSector(): ?int
    {
        return $this->sector;
    }

    public function setSector(?int $sector): void
    {
        $this->sector = $sector;
    }

    public function getRow(): ?int
    {
        return $this->row;
    }

    public function setRow(?int $row): void
    {
        $this->row = $row;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    public function getDeceasedNumber(): ?int
    {
        return $this->deceased_number;
    }

    public function setDeceasedNumber(?int $deceased_number): void
    {
        $this->deceased_number = $deceased_number;
    }

    public function getPaymentStatus(): ?PaymentStatusEnum
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(?PaymentStatusEnum $payment_status): void
    {
        $this->payment_status = $payment_status;
    }
}
