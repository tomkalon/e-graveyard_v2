<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Infrastructure\Repository\UserRepository as BaseUserRepository;
use App\Main\Domain\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;

class UserRepository extends BaseUserRepository implements BaseUserRepositoryInterface
{
}
