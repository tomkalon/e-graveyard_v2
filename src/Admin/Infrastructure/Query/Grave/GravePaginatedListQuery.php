<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Admin\Domain\View\Grave\GraveView;
use App\Core\Domain\Entity\Grave;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Exception;
use Knp\Component\Pager\Pagination\PaginationInterface;

class GravePaginatedListQuery implements GravePaginatedListQueryInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(
        ?int $page = null,
        ?GraveFilterView $filter = null,
        ?string $limit = null,
    ): PaginationInterface {
        $query = $this->repository->getGravesListQuery($filter);

        $gravesList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );

        $graveViewList = [];
        /** @var Grave $grave */
        foreach ($gravesList->getItems() as $grave) {
            $graveViewList[] = GraveView::fromEntity($grave);
        }
        $gravesList->setItems($graveViewList);

        return $gravesList;
    }
}
