<?php

namespace App\Admin\Infrastructure\Query\User;

use App\Core\Application\CQRS\Query\QueryInterface;

interface UserByFieldsQueryInterface extends QueryInterface
{
    public function execute(\App\Admin\Application\Dto\User\UserDto $dto): array;
}
