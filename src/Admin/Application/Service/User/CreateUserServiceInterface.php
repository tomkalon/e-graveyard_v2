<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;

interface CreateUserServiceInterface
{
    public function persist(UserView $userView): void;
}
