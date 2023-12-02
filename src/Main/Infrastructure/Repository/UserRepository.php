<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Entity\User;
use App\Main\Domain\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;
use App\Core\Repository\UserRepository as BaseUserRepository;

class UserRepository extends BaseUserRepository implements BaseUserRepositoryInterface
{
    public function findAllUserByAttrAndValue(string $attr, string $value): array
    {
        $qb = $this->createQueryBuilder('s')
            ->where("s.$attr = :value")
            ->setParameter('value', $value)
        ;

        $query = $qb->getQuery();
        return $query->execute();
    }
}
