<?php

namespace App\Admin\Application\Dto\Grave;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Person;

class GraveDto
{
    public ?int $sector;
    public ?int $row;
    public ?int $number;
    public ?string $positionX;
    public ?string $positionY;
    public ?string $graveyard;
    public ?array $people;
    public ?string $paymentStatus;

    public ?string $updatedAt;
    public ?string $createdAt;

    public function __construct(
        ?int $sector = null,
        ?int $row = null,
        ?int $number = null,
        ?string $positionX = null,
        ?string $positionY = null,
        ?string $graveyard = null,
        ?array $people = null,
        ?string $paymentStatus = null,
        ?string $updatedAt = null,
        ?string $createdAt = null
    ) {
        $this->sector = $sector;
        $this->row = $row;
        $this->number = $number;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->graveyard = $graveyard;
        $this->people = $people;
        $this->paymentStatus = $paymentStatus;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Grave $grave): self
    {
        $people = array_map(function ($person) {
        /** @var Person $person */
            return [
            'firstName' => $person->getFirstname(),
            'lastName' => $person->getLastName(),
            'bornDate' => $person->getBornDate()->format('Y-m-d'),
            'deathDate' => $person->getDeathDate()->format('Y-m-d')
            ];
        }, $grave->getPeople()->toArray());

        return new self(
            $grave->getSector(),
            $grave->getRow(),
            $grave->getNumber(),
            $grave->getPositionX(),
            $grave->getPositionY(),
            $grave->getGraveyard()->getName(),
            $people,
            $grave->getPaymentStatus()->name,
            $grave->getUpdatedAt()->format('Y-m-d'),
            $grave->getCreatedAt()->format('Y-m-d')
        );
    }
}
