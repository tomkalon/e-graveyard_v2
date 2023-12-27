<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Application\CQRS\Command\CommandInterface;

class GraveCommand implements CommandInterface
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
