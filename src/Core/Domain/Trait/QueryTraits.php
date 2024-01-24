<?php

namespace App\Core\Domain\Trait;

use Doctrine\ORM\QueryBuilder;

trait QueryTraits
{
    protected function isEqual(QueryBuilder $qb, string $column, $value, string $parameterName): void
    {
        $qb->andWhere($qb->expr()->eq($column, ':' . $parameterName));
        $qb->setParameter($parameterName, $value);
    }

    protected function addFilterIsEqualCondition(QueryBuilder $qb, ?string $column, $value, string $parameterName): void
    {
        if ($value !== null) {
            $qb->andWhere($qb->expr()->eq($column, ':' . $parameterName));
            $qb->setParameter($parameterName, $value);
        }
    }
}
