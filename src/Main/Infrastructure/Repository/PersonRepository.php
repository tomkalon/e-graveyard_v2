<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\PersonRepository as BasePersonRepository;
use App\Main\Domain\View\DeceasedSearchView;
use App\Main\Infrastructure\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
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

        $this->addFilterIsEqualCondition('p.firstname', $searchView->getFirstName(), 'firstName', $qb);
        $this->addFilterIsEqualCondition('p.lastname', $searchView->getLastName(), 'lastName', $qb);
        $this->addFilterIsEqualCondition('p.bornDate', $searchView->getBornYear(), 'deathDate', $qb);
        $this->addFilterIsEqualCondition('p.deathDate', $searchView->getDeathYear(), 'bornDate', $qb);

        return $qb->getQuery();
    }
}
