<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\PersonRepository as BasePersonRepository;
use Doctrine\ORM\Query;

class PersonRepository extends BasePersonRepository implements BasePersonRepositoryInterface
{
    use QueryTraits;

    public function getPeopleListQuery(): Query
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->addSelect('grave')
            ->leftJoin('p.grave', 'grave')
            ->addOrderBy('p.lastname')
            ->addOrderBy('p.firstname')
        ;
        return $qb->getQuery();
    }
}
