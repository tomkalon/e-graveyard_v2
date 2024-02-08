<?php

namespace App\Admin\Application\Command\User;

use App\Admin\Application\Service\User\CreateUserServiceInterface;
use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
