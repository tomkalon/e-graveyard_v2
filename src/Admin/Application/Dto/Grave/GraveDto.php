<?php

namespace App\Admin\Application\Dto\Grave;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Entity\Person;
use App\Core\Domain\Enum\PaymentStatusEnum;
use DateTimeImmutable;
use Doctrine\Common\Collections\Criteria;

class GraveDto
{
    public ?string $id;
    public ?int $sector;
    public ?int $row;
    public ?int $number;
    public ?string $positionX;
    public ?string $positionY;
    public ?array $graveyard;
    public ?array $people;
    public ?array $payments;
    public ?PaymentStatusEnum $paymentStatus = PaymentStatusEnum::UNPAID;

    public ?DateTimeImmutable $updatedAt;
    public ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string $id = null,
        ?int $sector = null,
        ?int $row = null,
        ?int $number = null,
        ?string $positionX = null,
        ?string $positionY = null,
        ?array $graveyard = null,
        ?array $people = null,
        ?array $payments = null,
        ?PaymentStatusEnum $paymentStatus = PaymentStatusEnum::UNPAID,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null
    ) {
        $this->id = $id;
        $this->sector = $sector;
        $this->row = $row;
        $this->number = $number;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->graveyard = $graveyard;
        $this->people = $people;
        $this->payments = $payments;
        $this->paymentStatus = $paymentStatus;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Grave $grave): self
    {
        // graveyard
        $graveyard = [
            'id' => $grave->getGraveyard()->getId(),
            'name' => $grave->getGraveyard()->getName(),
            'description' => $grave->getGraveyard()->getDescription(),
        ];

        // payments
        $payments = $grave->getPayments();
        $criteria = Criteria::create()->orderBy(['validity_time' => 'DESC']);
        $payments = array_values($payments->matching($criteria)->toArray());

        $paymentStatus = PaymentStatusEnum::UNPAID;
        if ($payments) {
            $lastFee = reset($payments);
            $now = new DateTimeImmutable();

            if ($now < $lastFee->getValidityTime()) {
                $paymentStatus = PaymentStatusEnum::PAID;
            } else {
                $paymentStatus = PaymentStatusEnum::EXPIRED;
            }
        }

        $paymentsGrave = [];
        /** @var PaymentGrave $fee */
        foreach ($payments as $fee) {
            $paymentsGrave[] = [
                'id' => $fee->getId(),
                'value' => $fee->getValue(),
                'currency' => $fee->getCurrency(),
                'validity_time' => $fee->getValidityTime(),
            ];
        }

        // people
        $people = $grave->getPeople()->toArray();
        $buried = [];
        /** @var Person $person */
        foreach ($people as $person) {
            $buried[] = [
                'id' => $person->getId(),
                'firstname' => $person->getFirstname(),
                'lastname' => $person->getLastname(),
                'born_date' => $person->getBornDate(),
                'death_date' => $person->getDeathDate()
            ];
        }

        return new self(
            $grave->getId(),
            $grave->getSector(),
            $grave->getRow(),
            $grave->getNumber(),
            $grave->getPositionX(),
            $grave->getPositionY(),
            $graveyard,
            $buried,
            $paymentsGrave,
            $paymentStatus,
            $grave->getUpdatedAt(),
            $grave->getCreatedAt()
        );
    }
}
