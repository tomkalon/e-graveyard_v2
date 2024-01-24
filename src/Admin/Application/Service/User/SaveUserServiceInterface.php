<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;

interface SaveUserServiceInterface
{
    public function persist(UserView $userView): void;
}
