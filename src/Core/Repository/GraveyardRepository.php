<?php

namespace App\Core\Repository;

use App\Core\Entity\Graveyard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<\App\Core\Entity\Graveyard>
 *
 * @method Graveyard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Graveyard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Graveyard[]    findAll()
 * @method Graveyard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GraveyardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Graveyard::class);
    }

//    /**
//     * @return Graveyard[] Returns an array of Graveyard objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Graveyard
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
