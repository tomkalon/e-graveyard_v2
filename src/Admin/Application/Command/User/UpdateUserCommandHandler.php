<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\User;

use App\Admin\Application\Service\User\UpdateUserServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

readonly class UpdateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UpdateUserServiceInterface $updateUserService,
    ) {}

    public function __invoke(UpdateUserCommand $command): void
    {
        $userView = $command->getUserView();
        if (!$userView->getId()) {
            throw new \InvalidArgumentException('User ID is required');
        }

        $this->updateUserService->update($userView);
    }
}
