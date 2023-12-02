<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Entity\User;
use App\Main\Domain\Dto\User\UserDto;
use App\Main\Domain\Repository\UserRepositoryInterface as BaseUserRepositoryInterface;
use App\Core\Repository\UserRepository as BaseUserRepository;

class UserRepository extends BaseUserRepository implements BaseUserRepositoryInterface
{
    public function getUsersByOptions(UserDto $dto): array
    {
        $qb = $this->createQueryBuilder('u');

        if ($dto->getEmail()) {
            $qb->andWhere(
                $qb->expr()->eq(
                    'u.email',
                    ':email'
                )
            );
            $qb->setParameter('email', $dto->getEmail());
        }
        return $qb->getQuery()->getResult();
    }

}
