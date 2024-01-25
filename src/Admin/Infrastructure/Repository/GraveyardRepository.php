<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\GraveyardRepositoryInterface as BaseGraveyardRepositoryInterface;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\GraveyardRepository as BaseGraveyardRepository;
use Doctrine\ORM\Query;

class GraveyardRepository extends BaseGraveyardRepository implements BaseGraveyardRepositoryInterface
{
    use QueryTraits;

    public function getGraveyardsListQuery(): Query
    {
        $qb = $this->createQueryBuilder('g');

        $qb
            ->leftJoin('g.graves', 'graves')
            ->leftJoin('graves.people', 'people')
            ->addSelect('graves')
            ->addOrderBy('g.name')
        ;
        return $qb->getQuery();
    }
    public function getGraveyardsPeopleNumber(): array
    {
        $qb = $this->createQueryBuilder('g');

        $qb
            ->leftJoin('g.graves', 'graves')
            ->leftJoin('graves.people', 'people')
            ->addSelect('graves')
            ->addSelect('people')
            ->groupBy('g.id')
            ->addSelect('count(people.id) as peopleNumber')
            ->addOrderBy('g.name')
        ;
        return $qb->getQuery()->execute();
    }
}
