<?php

namespace App\Admin\Domain\Dto\Grave;

use App\Core\Entity\Grave;
use App\Core\Entity\Graveyard;

class GraveDto
{
    public ?int $sector;
    public ?int $row = null;
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
    }

    public static function getFromEntity(Grave $grave): self
    {
        return new self(
            $grave->getSector(),
            $grave->getRow(),
            $grave->getNumber(),
            $grave->getPositionX(),
            $grave->getPositionY(),
            $grave->getGraveyard(),
        );
    }
}
