<?php

namespace App\Admin\Infrastructure\QueryBus\Grave;

use App\Admin\Infrastructure\Repository\GraveRepositoryInterface;
use App\Core\Components\Pagination\PaginatorInterface;
use App\Core\CQRS\QueryBus\QueryHandlerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

class GetGravePaginatedQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator
    ) {
    }

    public function __invoke(GetGravePaginatedQuery $query): PaginationInterface
    {
        $query = $this->repository->getGraveListQuery();
        return $this->paginator->paginate(
            $query
        );
    }
}
