<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Core\Application\CQRS\Query\QueryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface GravePaginatedListQueryInterface extends QueryInterface
{
    public function execute(
        ?int $page = null,
        ?GraveFilterView $filter = null,
        ?string $limit = null,
    ): PaginationInterface;
}
