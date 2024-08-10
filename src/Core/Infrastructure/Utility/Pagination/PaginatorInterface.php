<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Utility\Pagination;

use Knp\Component\Pager\Pagination\PaginationInterface;

interface PaginatorInterface
{
    public function paginate(
        $target,
        int $page = 1,
        int $limit = null,
        array $options = [],
    ): PaginationInterface;
}
