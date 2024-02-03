<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;

interface UpdateUserServiceInterface
{
    public function update(UserView $userView): void;
}
