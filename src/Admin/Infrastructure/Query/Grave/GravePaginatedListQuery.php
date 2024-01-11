<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Domain\Repository\GraveRepositoryInterface;
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
        ?string $limit = null,
    ): PaginationInterface {
        $query = $this->repository->getGravesListQuery();

        $paginationList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );

        $data = [];
        foreach ($paginationList->getItems() as $grave) {
            $data[] = GraveDto::fromEntity($grave);
        }

        $paginationList->setItems($data);
        return $paginationList;
    }
}
