<?php

namespace App\Main\Domain\Dto\Grave;

use App\Core\Entity\Graveyard;

class GraveDto
{
    public ?int $sector;
    public ?int $row;
    public ?int $number;
    public ?string $positionX;
    public ?string $positionY;
    public ?Graveyard $graveyard;
}
