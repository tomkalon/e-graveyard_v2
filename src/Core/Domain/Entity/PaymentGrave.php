<?php

namespace App\Core\Domain\Entity;

class PaymentGrave extends Payment
{
    private ?Grave $grave;

    public function getGrave(): ?Grave
    {
        return $this->grave;
    }

    public function setGrave(?Grave $grave): void
    {
        $this->grave = $grave;
    }
}
