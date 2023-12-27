<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\GraveyardRepositoryInterface as BaseGraveyardRepositoryInterface;
use App\Core\Application\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\GraveyardRepository as BaseGraveyardRepository;
use Doctrine\ORM\Query;

class GraveyardRepository extends BaseGraveyardRepository implements BaseGraveyardRepositoryInterface
{
    use QueryTraits;

    public function getGraveyardListQuery(): Query
    {
        $qb = $this->createQueryBuilder('g');
        $qb
            ->addOrderBy('g.name')
        ;
        return $qb->getQuery();
    }
}
