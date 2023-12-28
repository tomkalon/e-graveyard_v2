<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\UserRepository as BaseUserRepository;

class UserRepository extends BaseUserRepository implements BaseUserRepositoryInterface
{
    use QueryTraits;

    public function getUsersByOptions(?string $email = null, ?string $username = null): array
    {
        $qb = $this->createQueryBuilder('u');

        if ($email) {
            $this->isEqual('u.email', $email, $qb);
        }
        if ($username) {
            $this->isEqual('u.username', $username, $qb);
        }

        return $qb->getQuery()->getResult();
    }
}
