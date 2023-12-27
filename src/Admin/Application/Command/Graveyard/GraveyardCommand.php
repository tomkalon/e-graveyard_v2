<?php

namespace App\Admin\Application\Command\Graveyard;

use App\Admin\Application\Dto\Graveyard\GraveyardDto;
use App\Core\Application\CQRS\Command\CommandInterface;

class GraveyardCommand implements CommandInterface
{
    public function __construct(
        private readonly GraveyardDto $dto
    )
    {
    }

    public function getDto(): GraveyardDto
    {
        return $this->dto;
    }
}
