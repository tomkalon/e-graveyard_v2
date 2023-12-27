<?php

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Admin\Domain\Repository\GraveyardRepositoryInterface;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

class GraveyardPaginatedListQuery implements GraveyardPaginatedListQueryInterface
{
    public function __construct(
        private readonly GraveyardRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator
    )
    {
    }

    public function execute(
        ?int $page = null,
        ?string $limit = null
    ): PaginationInterface
    {
        $query = $this->repository->getGraveyardListQuery();
        return $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );
    }
}
