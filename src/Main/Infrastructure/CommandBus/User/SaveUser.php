<?php

namespace App\Main\Infrastructure\CommandBus\User;

use App\Core\CQRS\CommandBus\CommandInterface;
use App\Main\Domain\Dto\User\UserDto;

class SaveUser implements CommandInterface
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
