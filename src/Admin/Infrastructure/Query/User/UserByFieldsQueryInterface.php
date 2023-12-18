<?php

namespace App\Admin\Infrastructure\Query\User;

use App\Admin\Domain\Dto\User\UserDto;
use App\Core\CQRS\Query\QueryInterface;

interface UserByFieldsQueryInterface extends QueryInterface
{
    public function execute(UserDto $dto): array;
}
