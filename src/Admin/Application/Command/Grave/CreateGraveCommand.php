<?php

namespace App\Admin\Application\Command\Grave;

use App\Core\Application\CQRS\Command\CommandInterface;

class CreateGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly \App\Admin\Application\Dto\Grave\GraveDto $dto
    )
    {
    }

    public function getDto(): \App\Admin\Application\Dto\Grave\GraveDto
    {
        return $this->dto;
    }
}
