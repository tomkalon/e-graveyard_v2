<?php

namespace App\Admin\Infrastructure\Query\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;
use App\Core\Infrastructure\Utility\Pagination\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

class UserPaginatedListQuery implements UserPaginatedListQueryInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly PaginatorInterface $paginator,
    ) {
    }

    public function execute(
        ?int $page = null,
        ?string $limit = null
    ): PaginationInterface {
        $query = $this->repository->getUsersListQuery();
        $usersList = $this->paginator->paginate(
            $query,
            $page,
            $limit,
            ['limit_form' => $limit]
        );

        $userViewList = [];
        /** @var User $user */
        foreach ($usersList->getItems() as $index => $user) {
            $userViewList[$index] = UserView::fromEntity($user);
            $userViewList[$index]->setId($user->getId());
            $userViewList[$index]->setRoles($user->getRoles());
        }

        $usersList->setItems($userViewList);
        return $usersList;
    }
}
