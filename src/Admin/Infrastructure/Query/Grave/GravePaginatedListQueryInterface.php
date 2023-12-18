<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Dto\User\UserDto;
use App\Core\CQRS\Query\QueryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Form\FormInterface;

interface GravePaginatedListQueryInterface extends QueryInterface
{
    public function execute(
        ?int $page = null,
        ?FormInterface $limit = null
    ): PaginationInterface;
}
