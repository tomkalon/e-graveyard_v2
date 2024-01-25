<?php

namespace App\Core\Domain\Trait;

use Doctrine\ORM\QueryBuilder;

trait QueryTraits
{
    protected function equal(string $column, $value, string $parameterName, QueryBuilder $qb): void
    {
        $qb->andWhere($qb->expr()->eq($column, ':' . $parameterName));
        $qb->setParameter($parameterName, $value);
    }

    protected function addFilterIsEqualCondition(?string $column, $value, string $parameterName, QueryBuilder $qb): void
    {
        if ($value !== null) {
            $qb->andWhere($qb->expr()->eq($column, ':' . $parameterName));
            $qb->setParameter($parameterName, $value);
        }
    }
}
