<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\GraveRepository as BaseGraveRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class GraveRepository extends BaseGraveRepository implements BaseGraveRepositoryInterface
{
    use QueryTraits;

    /**
     * @throws NonUniqueResultException
     */
    public function getGrave(string $id): Grave
    {
        $qb = $this->createQueryBuilder('g');
        $this->addGraveRelationships($qb);

        $this->equal('g.id', $id, 'id', $qb);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getGravesListQuery(?GraveFilterView $filter): Query
    {
        $qb = $this->createQueryBuilder('g');
        $this->addGraveRelationships($qb);

        $qb
            ->leftJoin('g.main_image', 'mainImage')
            ->addSelect('mainImage')
            ->orderBy('g.sector', 'ASC')
            ->addOrderBy('g.row', 'ASC')
            ->addOrderBy('g.number', 'ASC');
        $this->addGraveFilter($qb, $filter);
        return $qb->getQuery();
    }

    /**
     * Add common entity relationships in query builder
     */
    private function addGraveRelationships(QueryBuilder $qb): void
    {
        $qb
            ->addSelect('graveyard')
            ->addSelect('people')
            ->addSelect('payments')
            ->addSelect('images')
            ->leftJoin('g.graveyard', 'graveyard')
            ->leftJoin('g.people', 'people')
            ->leftJoin('g.payments', 'payments')
            ->leftJoin('g.images', 'images');
    }

    /**
     * Add grave filter in query builder
     */
    private function addGraveFilter(QueryBuilder $qb, ?GraveFilterView $filter = null): void
    {
        if ($filter) {
            $this->addFilterIsEqualCondition('g.sector', $filter->getSector(), 'sector', $qb);
            $this->addFilterIsEqualCondition('g.row', $filter->getRow(), 'row', $qb);
            $this->addFilterIsEqualCondition('g.number', $filter->getNumber(), 'number', $qb);
            $this->addFilterIsEqualCondition('graveyard', $filter->getGraveyard(), 'graveyardFilter', $qb);
        }
    }
}
