<?php

namespace App\Admin\Application\Command\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Application\CQRS\Command\CommandInterface;

readonly class CreateUserCommand implements CommandInterface
{
    public function __construct(
        private UserView $userView
    )
    {
    }

    public function getUserView(): UserView
    {
        return $this->userView;
    }
}
