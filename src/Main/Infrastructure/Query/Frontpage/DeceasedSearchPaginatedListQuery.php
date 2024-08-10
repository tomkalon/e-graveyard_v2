<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Infrastructure\Query\Frontpage;

use App\Core\Domain\Entity\Person;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use App\Main\Domain\Repository\PersonRepositoryInterface;
use App\Main\Domain\View\Search\DeceasedSearchView;
use Knp\Component\Pager\Pagination\PaginationInterface;

class DeceasedSearchPaginatedListQuery implements DeceasedSearchPaginatedListQueryInterface
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository,
        private readonly PaginatorInterface $paginator,
    ) {}

    public function execute(
        ?int $page = null,
        ?string $limit = null,
        ?DeceasedSearchView $filter = null,
    ): PaginationInterface {
        $query = $this->personRepository->getPersonListQuery($filter);
        $deceasedList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit],
        );

        $deceasedViewList = [];
        /** @var Person $person */
        foreach ($deceasedList->getItems() as $person) {
            $deceasedViewList[] = new DeceasedSearchView(
                $person->getFirstname(),
                $person->getLastname(),
                null,
                null,
                $person->getBornDate(),
                $person->getDeathDate(),
                $person->getBornDateOnlyYear(),
                $person->getDeathDateOnlyYear(),
                $person->getGrave(),
            );
        }

        $deceasedList->setItems($deceasedViewList);
        return $deceasedList;
    }
}
