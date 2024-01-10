<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\GraveRepository as BaseGraveRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;

class GraveRepository extends BaseGraveRepository implements BaseGraveRepositoryInterface
{
    use QueryTraits;

    public function getGravesListQuery(): Query
    {
        $qb = $this->createQueryBuilder('g');
        $qb
            ->addSelect('graveyard')
            ->addSelect('people')
            ->addSelect('payments')
            ->leftJoin('g.graveyard', 'graveyard')
            ->leftJoin('g.people', 'people')
            ->leftJoin('g.payments', 'payments')
            ->addOrderBy('g.sector')
            ->addOrderBy('g.row')
            ->addOrderBy('g.number')
        ;
        return $qb->getQuery();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getGrave(string $id): Grave
    {
        $qb = $this->createQueryBuilder('g');
        $qb
            ->addSelect('graveyard')
            ->addSelect('people')
            ->addSelect('payments')
            ->leftJoin('g.graveyard', 'graveyard')
            ->leftJoin('g.people', 'people')
            ->leftJoin('g.payments', 'payments')
            ->orderBy('payments.validity_time', 'DESC');
        ;

        $this->isEqual('g.id', $id, $qb);

        return $qb->getQuery()->getSingleResult();
    }
}
