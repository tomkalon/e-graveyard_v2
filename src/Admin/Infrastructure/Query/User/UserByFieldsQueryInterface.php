<?php

namespace App\Admin\Infrastructure\Query\User;

use App\Admin\Application\Dto\User\UserDto;
use App\Core\Application\CQRS\Query\QueryInterface;

interface UserByFieldsQueryInterface extends QueryInterface
{
    public function execute(UserDto $dto): array;
}
