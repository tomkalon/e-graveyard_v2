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

            $this->addFilterIsEqualCondition($qb, 'u.email', $email, 'email');
            $this->addFilterIsEqualCondition($qb, 'u.username', $username, 'username');

        return $qb->getQuery()->getResult();
    }
}
