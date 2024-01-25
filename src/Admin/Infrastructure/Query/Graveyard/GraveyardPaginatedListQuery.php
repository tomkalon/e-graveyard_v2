<?php

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Admin\Domain\Repository\GraveyardRepositoryInterface;
use App\Admin\Domain\View\Graveyard\GraveyardView;
use App\Core\Domain\Entity\Graveyard;
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

        $graveyardsList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );

        /** @var GraveyardView[] $graveyardViewList */
        $graveyardViewList = [];

        /** @var Graveyard $graveyard */
        foreach ($graveyardsList->getItems() as $index => $graveyard) {
            $graveyardViewList[$index] = GraveyardView::fromEntity($graveyard);
            $graveyardViewList[$index]->countPeopleNumber();
        }
        $graveyardsList->setItems($graveyardViewList);

        return $graveyardsList;
    }
}
