<?php

namespace App\Admin\Domain\View\Grave;

use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Entity\Person;
use App\Core\Domain\Enum\PaymentStatusEnum;
use Exception;

class GraveView
{
    private ?string $id;
    private ?Graveyard $graveyard;
    private ?int $sector;
    private ?int $row;
    private ?int $number;

    private ?string $positionX;
    private ?string $positionY;

    /** @var Person[] $people */
    private ?array $people;
    private ?FileGrave $main_image;

    /** @var FileGrave[] $images */
    private ?array $images;

    /** @var PaymentGrave[] $payments */
    private ?array $payments;
    private ?PaymentStatusEnum $paymentStatus;

    public function __construct(
        ?string $id = null,
        ?Graveyard $graveyard = null,
        ?int $sector = null,
        ?int $row = null,
        ?int $number = null,
        ?string $positionX = null,
        ?string $positionY = null,
        ?array $people = null,
        ?FileGrave $main_image = null,
        ?array $images = null,
        ?array $payments = null,
        ?PaymentStatusEnum $paymentStatus = null
    ) {
        $this->id = $id;
        $this->graveyard = $graveyard;
        $this->sector = $sector;
        $this->row = $row;
        $this->number = $number;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->people = $people;
        $this->main_image = $main_image;
        $this->images = $images;
        $this->payments = $payments;
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @throws Exception
     */
    public static function fromEntity(Grave $grave): self
    {
        return new self(
            $grave->getId(),
            $grave->getGraveyard(),
            $grave->getSector(),
            $grave->getRow(),
            $grave->getNumber(),
            $grave->getPositionX(),
            $grave->getPositionY(),
            $grave->getPeople()->toArray(),
            $grave->getMainImage(),
            $grave->getImages()->toArray(),
            $grave->getPayments()->toArray(),
            $grave->getPaymentStatus()
        );
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getGraveyard(): ?Graveyard
    {
        return $this->graveyard;
    }

    public function setGraveyard(?Graveyard $graveyard): void
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

    public function getPositionX(): ?string
    {
        return $this->positionX;
    }

    public function setPositionX(?string $positionX): void
    {
        $this->positionX = $positionX;
    }

    public function getPositionY(): ?string
    {
        return $this->positionY;
    }

    public function setPositionY(?string $positionY): void
    {
        $this->positionY = $positionY;
    }

    public function getPeople(): ?array
    {
        return $this->people;
    }

    public function setPeople(?array $people): void
    {
        $this->people = $people;
    }

    public function getMainImage(): ?FileGrave
    {
        return $this->main_image;
    }

    public function setMainImage(?FileGrave $main_image): void
    {
        $this->main_image = $main_image;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function addImage(FileGrave $image): void
    {
        $this->images[] = $image;
    }

    public function getPayments(): ?array
    {
        return $this->payments;
    }

    public function setPayments(?array $payments): void
    {
        $this->payments = $payments;
    }

    public function getPaymentStatus(): ?PaymentStatusEnum
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(?PaymentStatusEnum $paymentStatus): void
    {
        $this->paymentStatus = $paymentStatus;
    }
}