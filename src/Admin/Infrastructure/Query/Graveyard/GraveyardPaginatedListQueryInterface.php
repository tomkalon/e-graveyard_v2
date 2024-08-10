<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Core\Application\CQRS\Query\QueryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface GraveyardPaginatedListQueryInterface extends QueryInterface
{
    public function execute(
        ?int $page = null,
        ?string $limit = null,
    ): PaginationInterface;
}
