<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Repository\GraveRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GraveRepository extends ServiceEntityRepository implements GraveRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grave::class);
    }
}
