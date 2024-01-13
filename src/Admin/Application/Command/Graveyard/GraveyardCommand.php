<?php

namespace App\Admin\Application\Command\Graveyard;

use App\Admin\Application\Dto\Graveyard\GraveyardDto;
use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Graveyard;

class GraveyardCommand implements CommandInterface
{
    public function __construct(
        private readonly Graveyard $graveyard
    ) {
    }

    public function getGraveyard(): Graveyard
    {
        return $this->graveyard;
    }
}
