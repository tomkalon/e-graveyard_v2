<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Repository\FileGraveRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FileGraveRepository extends ServiceEntityRepository implements FileGraveRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileGrave::class);
    }
}
