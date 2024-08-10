<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

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
