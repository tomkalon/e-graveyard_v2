<?php

namespace App\Admin\Infrastructure\CommandBus\User;

use App\Core\CQRS\CommandBus\CommandInterface;
use App\Admin\Domain\Dto\User\UserDto;

class CreateUserCommand implements CommandInterface
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
