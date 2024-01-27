<?php

namespace App\Core\Domain\Entity;

use App\Core\Domain\Enum\PaymentStatusEnum;
use App\Core\Domain\Trait\IdTrait;
use App\Core\Domain\Trait\LifecycleTrait;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Exception;

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
