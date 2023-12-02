<?php

namespace App\Main\Infrastructure\QueryBus;

use App\Core\CQRS\QueryBus\QueryInterface;
use App\Main\Domain\Dto\User\UserDto;

class GetUsersByOptionsQuery implements QueryInterface
{
    public function __construct(
        private readonly UserDto $dto
    )
    {
    }

    public function getDto(): UserDto
    {
        return $this->dto;
    }
}
