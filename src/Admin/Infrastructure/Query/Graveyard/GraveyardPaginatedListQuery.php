<?php

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Admin\Application\Dto\Graveyard\GraveyardDto;
use App\Admin\Domain\Repository\GraveyardRepositoryInterface;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

class GraveyardPaginatedListQuery implements GraveyardPaginatedListQueryInterface
{
    public function __construct(
        private readonly GraveyardRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator
    ) {
    }

    public function execute(
        ?int $page = null,
        ?string $limit = null
    ): PaginationInterface {
        $query = $this->repository->getGraveyardsListQuery();

        $paginationList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );

        $data = [];
        foreach ($paginationList->getItems() as $graveyard) {
            $data[] = GraveyardDto::fromEntity($graveyard);
        }

        $paginationList->setItems($data);
        return $paginationList;
    }
}
