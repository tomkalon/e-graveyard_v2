<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Repository\GraveyardRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GraveyardRepository extends ServiceEntityRepository implements GraveyardRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Graveyard::class);
    }
}
