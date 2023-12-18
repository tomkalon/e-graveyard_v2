<?php

namespace App\Admin\Infrastructure\Repository;

use App\Core\Repository\GraveRepository as BaseGraveRepository;
use App\Admin\Infrastructure\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use App\Core\Trait\QueryTraits;
use Doctrine\ORM\Query;

class GraveRepository extends BaseGraveRepository implements BaseGraveRepositoryInterface
{
    use QueryTraits;


    public function getGraveListQuery(): Query
    {
        $qb = $this->createQueryBuilder('pag');
        $qb->orderBy('pag.sector')
            ->addOrderBy('pag.row')
            ->addOrderBy('pag.number')
        ;
        return $qb->getQuery();
    }
}
