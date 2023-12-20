<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\Graveyard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GraveyardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Graveyard::class);
    }
}
