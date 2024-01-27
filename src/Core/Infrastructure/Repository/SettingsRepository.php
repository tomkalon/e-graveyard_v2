<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\Settings;
use App\Core\Domain\Repository\SettingsRepositoryInterface;
use App\Core\Domain\Trait\QueryTraits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

class SettingsRepository extends ServiceEntityRepository implements SettingsRepositoryInterface
{
    use QueryTraits;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Settings::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getSettings(): Settings
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->setMaxResults(1);

        $this->equal('s.id', 'settings', 'id', $qb);
        return $qb->getQuery()->getOneOrNullResult();
    }
}
