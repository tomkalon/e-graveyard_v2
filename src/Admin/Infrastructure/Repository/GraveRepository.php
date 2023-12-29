<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\GraveRepository as BaseGraveRepository;
use Doctrine\ORM\Query;

class GraveRepository extends BaseGraveRepository implements BaseGraveRepositoryInterface
{
    use QueryTraits;


    public function getGraveListQuery(): Query
    {
        $qb = $this->createQueryBuilder('g');
        $qb
            ->addSelect('graveyard')
            ->addSelect('people')
            ->leftJoin('g.graveyard', 'graveyard')
            ->leftJoin('g.people', 'people')
            ->addOrderBy('g.sector')
            ->addOrderBy('g.row')
            ->addOrderBy('g.number')
        ;
        return $qb->getQuery();
    }
}
