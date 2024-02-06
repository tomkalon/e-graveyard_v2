<?php

namespace App\Admin\Application\Command\User;

use App\Admin\Application\Service\User\CreateUserServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

readonly class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateUserServiceInterface $saveUserService,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $userView = $command->getUserView();

        $this->saveUserService->persist($userView);
    }
}
