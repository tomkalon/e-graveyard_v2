<?php

namespace App\Admin\Application\Command\User;

use App\Admin\Application\Dto\User\UserDto;
use App\Core\Application\CQRS\Command\CommandInterface;

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
