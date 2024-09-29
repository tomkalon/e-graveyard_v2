<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Person;

use App\Admin\Domain\Repository\PersonRepositoryInterface;
use App\Admin\Domain\View\Person\PersonFilterView;
use App\Admin\Domain\View\Person\PersonView;
use App\Core\Domain\Entity\Person;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

readonly class PersonPaginatedListQuery implements PersonPaginatedListQueryInterface
{
    public function __construct(
        private PersonRepositoryInterface $repository,
        private PaginatorInterface        $paginator,
    ) {}

    public function execute(
        ?int $page = null,
        ?string $limit = null,
        ?PersonFilterView $filter = null,
    ): PaginationInterface {
        $query = $this->repository->getPeopleListQuery($filter);

        $peopleList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit],
        );

        $peopleViewList = [];
        /** @var Person $person */
        foreach ($peopleList->getItems() as $person) {
            $peopleViewList[] = PersonView::fromEntity($person);
        }
        $peopleList->setItems($peopleViewList);
        return $peopleList;
    }
}
