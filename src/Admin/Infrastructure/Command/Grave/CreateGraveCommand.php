<?php

namespace App\Admin\Infrastructure\Command\Grave;

use App\Core\CQRS\Command\CommandInterface;
use App\Admin\Domain\Dto\Grave\GraveDto;

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
