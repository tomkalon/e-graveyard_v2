<?php

namespace App\Admin\Infrastructure\Query\Person;

use App\Core\Application\CQRS\Query\QueryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface PersonPaginatedListQueryInterface extends QueryInterface
{
    public function execute(
        ?int $page = null,
        ?string $limit = null,
    ): PaginationInterface;
}
