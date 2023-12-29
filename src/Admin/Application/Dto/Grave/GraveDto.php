<?php

namespace App\Admin\Application\Dto\Grave;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;

class GraveDto
{
    public ?int $sector;
    public ?int $row;
    public ?int $number;
    public ?string $positionX;
    public ?string $positionY;
    public ?Graveyard $graveyard;

    public function __construct(
        ?int $sector = null,
        ?int $row = null,
        ?int $number = null,
        ?string $positionX = null,
        ?string $positionY = null,
        ?Graveyard $graveyard = null
    ) {
        $this->sector = $sector;
        $this->row = $row;
        $this->number = $number;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->graveyard = $graveyard;
    }

    public static function fromEntity(Grave $grave): self
    {
        return new self(
            $grave->getSector(),
            $grave->getRow(),
            $grave->getNumber(),
            $grave->getPositionX(),
            $grave->getPositionY(),
            $grave->getGraveyard()
        );
    }

    public function toArray(): array
    {
        return [
            'graveyard' => $this->graveyard->getName(),
            'sector' => $this->sector,
            'row' => $this->row,
            'number' => $this->number,
            'positionX' => $this->positionX,
            'positionY' => $this->positionY,
        ];
    }
}
