<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Infrastructure\Repository;

use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\PersonRepository as BasePersonRepository;
use App\Main\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use App\Main\Domain\View\Search\DeceasedSearchView;
use Doctrine\ORM\Query;

class PersonRepository extends BasePersonRepository implements BasePersonRepositoryInterface
{
    use QueryTraits;

    public function getPersonListQuery(DeceasedSearchView $searchView): Query
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->leftJoin('p.grave', 'grave')
            ->leftJoin('grave.graveyard', 'graveyard')
            ->addSelect('grave')
            ->addSelect('graveyard');

        $this->isInThisYear('p.born_date', $searchView->getBornYear(), 'born', $qb);
        $this->isInThisYear('p.death_date', $searchView->getDeathYear(), 'death', $qb);

        $this->addFilterIsEqualCondition('p.firstname', $searchView->getFirstName(), 'firstName', $qb);
        $this->addFilterIsEqualCondition('p.lastname', $searchView->getLastName(), 'lastName', $qb);

        return $qb->getQuery();
    }
}
