<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Infrastructure\Query\Frontpage;

use App\Main\Domain\View\Search\DeceasedSearchView;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface DeceasedSearchPaginatedListQueryInterface
{
    public function execute(
        ?int $page = null,
        ?string $limit = null,
        ?DeceasedSearchView $filter = null,
    ): PaginationInterface;
}
