<?php

namespace App\Core\Repository;

use App\Core\Entity\Grave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<\App\Core\Entity\Grave>
 *
 * @method Grave|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grave|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grave[]    findAll()
 * @method Grave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GraveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grave::class);
    }

//    /**
//     * @return Grave[] Returns an array of Grave objects
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

//    public function findOneBySomeField($value): ?Grave
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
