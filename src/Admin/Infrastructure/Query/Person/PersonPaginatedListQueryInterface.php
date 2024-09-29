<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Person;

use App\Admin\Domain\View\Person\PersonFilterView;
use App\Core\Application\CQRS\Query\QueryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface PersonPaginatedListQueryInterface extends QueryInterface
{
    public function execute(
        ?int $page = null,
        ?string $limit = null,
        ?PersonFilterView $filter = null,
    ): PaginationInterface;
}
