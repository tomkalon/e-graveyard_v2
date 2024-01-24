<?php

namespace App\Admin\Application\Command\User;

use App\Admin\Application\Service\User\SaveUserServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly SaveUserServiceInterface $saveUserService,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $userView = $command->getUserView();
        $this->saveUserService->persist($userView);
    }
}
