<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use App\Admin\Domain\View\Person\PersonFilterView;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\PersonRepository as BasePersonRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class PersonRepository extends BasePersonRepository implements BasePersonRepositoryInterface
{
    use QueryTraits;

    public function getPeopleListQuery(?PersonFilterView $filter): Query
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->leftJoin('p.grave', 'grave')
            ->leftJoin('grave.graveyard', 'graveyard')
            ->addSelect('grave')
            ->addSelect('graveyard')
            ->orderBy('p.lastname', 'ASC')
            ->addOrderBy('p.firstname', 'ASC')
        ;

        $this->addPersonFilter($qb, $filter);
        return $qb->getQuery();
    }

    /**
     * Add grave filter in query builder
     */
    private function addPersonFilter(QueryBuilder $qb, ?PersonFilterView $filter = null): void
    {
        if ($filter) {
            $this->isInThisYear('p.born_date', $filter->getBornYear(), 'born', $qb);
            $this->isInThisYear('p.death_date', $filter->getDeathYear(), 'death', $qb);

            $this->addFilterIsEqualCondition('p.firstname', $filter->getFirstName(), 'firstName', $qb);
            $this->addFilterIsEqualCondition('p.lastname', $filter->getLastName(), 'lastName', $qb);
        }
    }
}
