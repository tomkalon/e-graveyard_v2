<?php

namespace App\Main\Infrastructure\CommandBus\User;

use App\Core\CQRS\CommandBus\CommandHandlerInterface;
use App\Core\Entity\User;
use App\Main\Infrastructure\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use UnexpectedValueException;

class SaveUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface      $em,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly UserRepositoryInterface     $userRepository
    )
    {
    }

    public function __invoke(SaveUser $command): void
    {
        $dto = $command->getDto();

        if ($dto->getId()) {
            $user = $this->userRepository->find($dto->getId());
            if (!$user) {
                throw new UnexpectedValueException('Element cannot be null -> User::class');
            }
        } else {
            $user = new User();
            if ($dto->getEmail()) {
                $user->setEmail($dto->getEmail());
            } else {
                throw new UnexpectedValueException('Element cannot be null -> email');
            }

            if ($dto->getUsername()) {
                $user->setUsername($dto->getUsername());
            } else {
                throw new UnexpectedValueException('Element cannot be null -> username');
            }

            if (!$dto->getPassword()) {
                throw new UnexpectedValueException('Element cannot be null -> password');
            }
        }

        if ($dto->getRoles()) {
            $user->setRoles($dto->getRoles());
        }

        if ($dto->getIsVerified()) {
            $user->setIsVerified($dto->getIsVerified());
        }

        if ($dto->getPassword()) {
            $password = $this->hasher->hashPassword($user, $dto->getPassword());
            $user->setPassword($password);
        }

        $this->em->persist($user);
    }
}
