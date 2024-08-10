<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Admin\Domain\View\Grave\GraveView;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Repository\SettingsRepositoryInterface;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Exception;
use Knp\Component\Pager\Pagination\PaginationInterface;

class GravePaginatedListQuery implements GravePaginatedListQueryInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator,
        private readonly SettingsRepositoryInterface $settingsRepository,
    ) {}

    /**
     * @throws Exception
     */
    public function execute(
        ?int $page = null,
        ?string $limit = null,
        ?GraveFilterView $filter = null,
    ): PaginationInterface {
        $query = $this->repository->getGravesListQuery($filter);
        $gravesList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit],
        );

        $settings = $this->settingsRepository->getSettings();

        $graveViewList = [];
        /** @var Grave $grave */
        foreach ($gravesList->getItems() as $grave) {
            $graveViewList[] = GraveView::fromEntity($grave, $settings->getGravePaymentExpirationTime());
        }

        $gravesList->setItems($graveViewList);
        return $gravesList;
    }
}
