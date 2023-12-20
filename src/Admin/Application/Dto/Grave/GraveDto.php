<?php

namespace App\Admin\Application\Dto\Grave;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;

class GraveDto
{
    public ?int $sector;
    public ?int $row = null;
    public ?int $number;
    public ?string $positionX = null;
    public ?string $positionY = null;
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
