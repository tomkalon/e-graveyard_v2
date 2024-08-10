<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;

interface UpdateUserServiceInterface
{
    public function update(UserView $userView): void;
}
