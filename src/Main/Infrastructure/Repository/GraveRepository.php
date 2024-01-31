<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Trait\QueryTraits;
use App\Core\Infrastructure\Repository\GraveRepository as BaseGraveRepository;
use App\Main\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use Doctrine\ORM\NonUniqueResultException;

class GraveRepository extends BaseGraveRepository implements BaseGraveRepositoryInterface
{
    use QueryTraits;

    /**
     * @throws NonUniqueResultException
     */
    public function getGrave(string $id): Grave
    {
        $qb = $this->createQueryBuilder('g');
        $qb->addSelect('graveyard')
            ->addSelect('people')
            ->addSelect('payments')
            ->addSelect('images')
            ->leftJoin('g.graveyard', 'graveyard')
            ->leftJoin('g.people', 'people')
            ->leftJoin('g.payments', 'payments')
            ->leftJoin('g.images', 'images');
        $qb
            ->setMaxResults(1);

        $this->equal('g.id', $id, 'id', $qb);
        return $qb->getQuery()->getOneOrNullResult();
    }
}
