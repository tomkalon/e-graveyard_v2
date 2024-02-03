<?php

namespace App\Admin\Application\Command\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class RemoveUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function __invoke(RemoveUserCommand $command)
    {
        try {
            $user = $this->userRepository->find($command->getId());
            if ($user) {
                $this->em->remove($user);
                $this->em->flush();
            } else {
                throw new EntityNotFoundException();
            }
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
