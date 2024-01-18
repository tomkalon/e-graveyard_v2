<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\FileGrave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FileGraveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileGrave::class);
    }
}
