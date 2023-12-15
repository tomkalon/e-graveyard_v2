<?php

namespace App\Admin\Domain\Dto\Grave;

use App\Core\Entity\Graveyard;

class GraveDto
{
    public ?int $sector;
    public ?int $row = null;
    public ?int $number;
    public ?string $positionX;
    public ?string $positionY;
    public ?Graveyard $graveyard;
}
