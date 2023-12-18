<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Dto\User\UserDto;
use App\Core\CQRS\Query\QueryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface GravePaginatedListQueryInterface extends QueryInterface
{
    public function execute(
        ?int $page = null,
        ?int $limit = null,
    ): PaginationInterface;
}
