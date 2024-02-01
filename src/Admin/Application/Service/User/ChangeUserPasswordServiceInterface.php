<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;

interface ChangeUserPasswordServiceInterface
{
    public function changePassword(UserView $userView): void;
}
