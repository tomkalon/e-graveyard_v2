<?php

namespace App\Admin\Application\Command\User;

use App\Admin\Application\Service\User\ChangeUserPasswordServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

class ChangeUserPasswordCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ChangeUserPasswordServiceInterface $changeUserPasswordService,

    ) {
    }

    public function __invoke(ChangeUserPasswordCommand $command): void
    {
        $userView = $command->getUserView();
        $this->changeUserPasswordService->changePassword($userView);
    }
}
