<?php

namespace App\Admin\Infrastructure\Command\User;

use App\Core\CQRS\Command\CommandInterface;
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
