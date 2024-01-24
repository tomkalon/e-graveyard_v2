<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

class GravePaginatedListQuery implements GravePaginatedListQueryInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator
    ) {
    }
    public function execute(
        ?int $page = null,
        ?GraveFilterView $filter = null,
        ?string $limit = null,
    ): PaginationInterface {
        $query = $this->repository->getGravesListQuery($filter);
        return $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );
    }
}
