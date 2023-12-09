<?php

namespace App\Main\Infrastructure\CommandBus\Grave;

use App\Core\CQRS\CommandBus\CommandInterface;
use App\Main\Domain\Dto\Grave\GraveDto;

class CreateGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly GraveDto $dto
    )
    {
    }

    public function getDto(): GraveDto
    {
        return $this->dto;
    }
}
