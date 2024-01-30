<?php

namespace App\Core\Domain\Trait;

use DateTimeImmutable;
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

    protected function isInThisYear(?string $column, ?int $value, string $parameterName, QueryBuilder $qb): void
    {
        if ($value) {
            $deathYear = DateTimeImmutable::createFromFormat('Y', $value);
            $qb->andWhere($column . ' >= :' . $parameterName . 'YearBegin and ' . $column . ' <= :' . $parameterName . 'YearEnd')
                ->setParameter($parameterName . 'YearBegin', $deathYear->modify('first day of january 00:00:00'))
                ->setParameter($parameterName . 'YearEnd', $deathYear->modify('last day of this year 23:59:59'));
        }
    }
}
