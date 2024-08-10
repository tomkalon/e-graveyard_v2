<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Admin\Domain\View\User\UserView;

class UserByFieldsQuery implements UserByFieldsQueryInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}
    public function execute(UserView $userView): ?array
    {
        return $this->userRepository->getUsersByOptions(
            $userView->getEmail(),
            $userView->getUsername(),
        );
    }
}
