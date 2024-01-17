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

class Grave
{
    use IdTrait;
    use LifecycleTrait;

    private int $sector;
    private ?int $row;
    private int $number;
    private ?string $positionX;
    private ?string $positionY;
    private ?Graveyard $graveyard;
    private ?File $main_image;
    private ?Collection $people;
    private ?Collection $images;
    private ?Collection $payments;

    public function __construct()
    {
        $this->people = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getSector(): int
    {
        return $this->sector;
    }

    public function setSector(int $sector): void
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

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getGraveyard(): ?Graveyard
    {
        return $this->graveyard;
    }

    public function setGraveyard(?Graveyard $graveyard): void
    {
        $this->graveyard = $graveyard;
    }

    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPeople(Person $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people->add($person);
            $person->setGrave($this);
        }

        return $this;
    }

    public function getImages(): ?Collection
    {
        return $this->images;
    }

    public function addImages(File $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setGrave($this);
        }

        return $this;
    }

    public function getPayments(): ?Collection
    {
        return $this->payments;
    }

    public function addPayments(PaymentGrave $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setGrave($this);
        }

        return $this;
    }

    public function getPaymentStatus(): PaymentStatusEnum
    {
        $criteria = Criteria::create()->orderBy(['validity_time' => 'DESC']);

        /** @var Collection $payments */
        $payments = $this->payments->matching($criteria);
        if (!$payments->isEmpty()) {
            $lastFee = $payments->first();
            $now = new DateTimeImmutable();

            if ($now < $lastFee->getValidityTime()) {
                return PaymentStatusEnum::PAID;
            } else {
                return PaymentStatusEnum::EXPIRED;
            }
        }
        return PaymentStatusEnum::UNPAID;
    }

    public function getPositionX(): ?string
    {
        return $this->positionX;
    }
    public function setPositionX(?string $positionX):void
    {
        $this->positionX = $positionX;
    }
    public function getPositionY(): ?string
    {
        return $this->positionY;
    }
    public function setPositionY(?string $positionY):void
    {
        $this->positionY = $positionY;
    }

    public function getMainImage(): ?File
    {
        return $this->main_image;
    }

    public function setMainImage(?File $main_image): void
    {
        $this->main_image = $main_image;
    }
}
