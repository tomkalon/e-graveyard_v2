<?php

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
        $this->addEntityRelationships($qb);

        $qb
            ->setMaxResults(1);

        $this->isEqual($qb, 'g.id', $id, 'id');
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getGravesListQuery(?GraveFilterView $filter): Query
    {
        $qb = $this->createQueryBuilder('g');
        $this->addEntityRelationships($qb);

        $qb
            ->addSelect('mainImage')
            ->leftJoin('g.main_image', 'mainImage')
            ->addOrderBy('g.createdAt', 'DESC');

        if ($filter) {
            $this->addFilterIsEqualCondition($qb, 'g.sector', $filter->getSector(), 'sector');
            $this->addFilterIsEqualCondition($qb, 'g.row', $filter->getRow(), 'row');
            $this->addFilterIsEqualCondition($qb, 'g.number', $filter->getNumber(), 'number');
            $this->addFilterIsEqualCondition($qb, 'graveyard', $filter->getGraveyard(), 'graveyardFilter');
        }

        return $qb->getQuery();
    }

    /**
     * Add common entity relationships in query builder
     */
    private function addEntityRelationships(QueryBuilder $qb): void
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
}
