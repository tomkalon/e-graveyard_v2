<?php

namespace App\Core\Infrastructure\Utility\Pagination;

use Knp\Component\Pager\Pagination\PaginationInterface;

interface PaginatorInterface
{
    public function paginate(
        $target,
        int $page = 1,
        int $limit = null,
        array $options = []
    ): PaginationInterface;
}
