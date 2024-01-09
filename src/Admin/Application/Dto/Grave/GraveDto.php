<?php

namespace App\Admin\Application\Dto\Grave;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\Payment;
use App\Core\Domain\Entity\PaymentGrave;

class GraveDto
{
    public ?int $sector;
    public ?int $row;
    public ?int $number;
    public ?string $positionX;
    public ?string $positionY;
    public ?Graveyard $graveyard;
    public ?array $people;
    public ?array $payments;

    public function __construct(
        ?int $sector = null,
        ?int $row = null,
        ?int $number = null,
        ?string $positionX = null,
        ?string $positionY = null,
        ?Graveyard $graveyard = null,
        ?array $people = null,
        ?array $payments = null
    ) {
        $this->sector = $sector;
        $this->row = $row;
        $this->number = $number;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->graveyard = $graveyard;
        $this->people = $people;
        $this->payments = $payments;
    }

    public static function fromEntity(Grave $grave): self
    {
        return new self(
            $grave->getSector(),
            $grave->getRow(),
            $grave->getNumber(),
            $grave->getPositionX(),
            $grave->getPositionY(),
            $grave->getGraveyard(),
            $grave->getPeople()->toArray(),
            $grave->getPayments()->toArray()
        );
    }
}
