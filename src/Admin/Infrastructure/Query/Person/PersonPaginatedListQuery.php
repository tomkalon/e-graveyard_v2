<?php

namespace App\Admin\Infrastructure\Query\Person;

use App\Admin\Application\Dto\Person\PersonDto;
use App\Admin\Domain\Repository\PersonRepositoryInterface;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

class PersonPaginatedListQuery implements PersonPaginatedListQueryInterface
{
    public function __construct(
        private readonly PersonRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator
    ) {
    }

    public function execute(
        ?int $page = null,
        ?string $limit = null
    ): PaginationInterface {
        $query = $this->repository->getPeopleListQuery();

        return  $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );
    }
}
