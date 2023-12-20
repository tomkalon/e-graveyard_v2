<?php

namespace App\Admin\Domain\Repository;

use App\Core\Domain\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;

interface UserRepositoryInterface extends BaseUserRepositoryInterface
{
    public function getUsersByOptions(?string $email = null, ?string $username = null): array;
}
