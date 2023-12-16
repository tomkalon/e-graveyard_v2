<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Repository\UserRepository as BaseUserRepository;
use App\Main\Infrastructure\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;

class UserRepository extends BaseUserRepository implements BaseUserRepositoryInterface
{
}
