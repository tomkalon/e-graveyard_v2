<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Domain\View\Grave;

use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\Person;
use App\Core\Domain\Enum\PaymentStatusEnum;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
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
    private ?PaymentStatusEnum $paymentStatus;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

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
        ?PaymentStatusEnum $paymentStatus = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null,
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
        $this->paymentStatus = $paymentStatus;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    /**
     * @throws Exception
     */
    public static function fromEntity(Grave $grave, ?string $gravePaymentExpirationTime = null): self
    {
        $paymentsStatus = self::processingPaymentsStatus($grave, $gravePaymentExpirationTime);

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
            $paymentsStatus,
            $grave->getUpdatedAt(),
            $grave->getCreatedAt(),
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

    /**
     * @param Grave $grave
     * @param string|null $gravePaymentExpirationTime
     * @return PaymentStatusEnum
     */
    public static function processingPaymentsStatus(Grave $grave, ?string $gravePaymentExpirationTime): PaymentStatusEnum
    {
        $criteria = Criteria::create()->orderBy(['validity_time' => 'DESC']);
        $paymentsStatus = PaymentStatusEnum::UNPAID;

        /** @var Collection $payments */
        $payments = $grave->getPayments()->matching($criteria);
        if (!$payments->isEmpty()) {
            $lastFee = $payments->first()->getValidityTime();
            $now = new DateTimeImmutable();

            if ($gravePaymentExpirationTime) {
                if ($now < $lastFee) {
                    $paymentsStatus = ($lastFee->modify($gravePaymentExpirationTime) < $now) ? PaymentStatusEnum::SOON : PaymentStatusEnum::PAID;
                } else {
                    $paymentsStatus = PaymentStatusEnum::EXPIRED;
                }
            } else {
                $paymentsStatus = ($now < $lastFee) ? PaymentStatusEnum::PAID : PaymentStatusEnum::EXPIRED;
            }
        }
        return $paymentsStatus;
    }

    public function getPeopleNumber(): ?int
    {
        return count($this->people);
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

    public function getPaymentStatus(): ?PaymentStatusEnum
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(?PaymentStatusEnum $paymentStatus): void
    {
        $this->paymentStatus = $paymentStatus;
    }

    public function calculatePaymentStatus(Grave $grave, ?string $gravePaymentExpirationTime = null): void
    {
        $paymentsStatus = self::processingPaymentsStatus($grave, $gravePaymentExpirationTime);
        $this->paymentStatus = $paymentsStatus;
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
