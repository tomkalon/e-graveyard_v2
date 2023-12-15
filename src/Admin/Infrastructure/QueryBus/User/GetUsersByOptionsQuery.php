<?php

namespace App\Admin\Infrastructure\QueryBus\User;

use App\Core\CQRS\QueryBus\QueryInterface;
use App\Admin\Domain\Dto\User\UserDto;

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
