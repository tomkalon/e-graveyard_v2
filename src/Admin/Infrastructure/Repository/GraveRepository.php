<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\GraveRepository as BaseGraveRepository;
use Doctrine\ORM\Query;

class GraveRepository extends BaseGraveRepository implements BaseGraveRepositoryInterface
{
    use QueryTraits;

    public function getGravesListQuery(?GraveFilterView $filter): Query
    {
        $qb = $this->createQueryBuilder('g');
        $qb
            ->addSelect('graveyard')
            ->addSelect('people')
            ->addSelect('payments')
            ->leftJoin('g.graveyard', 'graveyard')
            ->leftJoin('g.people', 'people')
            ->leftJoin('g.payments', 'payments')
            ->addOrderBy('g.createdAt', 'DESC')
        ;

        if ($filter) {
            $this->addFilterIsEqualCondition($qb, 'g.sector', $filter->getSector(), 'sector');
            $this->addFilterIsEqualCondition($qb, 'g.row', $filter->getRow(), 'row');
            $this->addFilterIsEqualCondition($qb, 'g.number', $filter->getNumber(), 'number');
            $this->addFilterIsEqualCondition($qb, 'graveyard', $filter->getGraveyard(), 'graveyardFilter');
        }

        return $qb->getQuery();
    }
}
