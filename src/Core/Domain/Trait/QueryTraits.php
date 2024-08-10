<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

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
            $year = DateTimeImmutable::createFromFormat('Y', $value);
            $yearBegin = $year->modify('first day of january 00:00:00');
            $yearEnd = $year->modify('last day of december 23:59:59');

            $qb->andWhere($column . ' >= :' . $parameterName . 'YearBegin and ' . $column . ' <= :' . $parameterName . 'YearEnd')
                ->setParameter($parameterName . 'YearBegin', $yearBegin->format('Y-m-d'))
                ->setParameter($parameterName . 'YearEnd', $yearEnd->format('Y-m-d'));
        }
    }
}
