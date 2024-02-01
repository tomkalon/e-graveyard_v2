<?php

namespace App\Admin\Domain\Repository;

use App\Core\Domain\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;
use Doctrine\ORM\Query;

interface UserRepositoryInterface extends BaseUserRepositoryInterface
{
    public function getUsersByOptions(?string $email = null, ?string $username = null): array;
    public function getUsersListQuery(): Query;
}
