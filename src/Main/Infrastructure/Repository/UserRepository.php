<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Entity\User;
use App\Main\Domain\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;
use App\Core\Repository\UserRepository as BaseUserRepository;

class UserRepository extends BaseUserRepository implements BaseUserRepositoryInterface
{
}
