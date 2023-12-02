<?php

namespace App\Main\Domain\Repository;

use App\Core\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;
use App\Main\Domain\Dto\User\UserDto;

interface UserRepositoryInterface extends BaseUserRepositoryInterface
{
    public function getUsersByOptions(UserDto $dto): array;

}
