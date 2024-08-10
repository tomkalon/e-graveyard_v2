<?php

namespace App\Core\Domain\Entity;

use App\Core\Domain\Trait\LifecycleTrait;

class Settings
{
    use LifecycleTrait;


    private string $id = 'settings';

    private string $gravePaymentExpirationTime = '-3 months';

    public function getId(): string
    {
        return $this->id;
    }

    public function getGravePaymentExpirationTime(): string
    {
        return $this->gravePaymentExpirationTime;
    }

    public function setGravePaymentExpirationTime(string $gravePaymentExpirationTime): void
    {
        $this->gravePaymentExpirationTime = $gravePaymentExpirationTime;
    }
}
