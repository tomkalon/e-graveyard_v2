<?php

namespace App\Core\Domain\Trait;

use Doctrine\ORM\QueryBuilder;

trait QueryTraits
{
    public function isEqual(?string $column, ?string $parameter, QueryBuilder $qb): void
    {
        $qb->andWhere(
            $qb->expr()->eq(
                $column,
                ':parameter'
            )
        );
        $qb->setParameter('parameter', $parameter);
    }
}
