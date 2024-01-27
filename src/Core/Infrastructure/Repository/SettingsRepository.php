<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\Settings;
use App\Core\Domain\Repository\SettingsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SettingsRepository extends ServiceEntityRepository implements SettingsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Settings::class);
    }
}
