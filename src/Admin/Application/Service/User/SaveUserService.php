<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use UnexpectedValueException;

class SaveUserService implements SaveUserServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface      $em,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly UserRepositoryInterface     $userRepository
    ) {
    }
    public function persist(UserView $userView): void
    {

        if ($userView->getId()) {
            $user = $this->userRepository->find($userView->getId());
            if (!$user) {
                throw new UnexpectedValueException('Element cannot be null -> User::class');
            }
        } else {
            $user = new User();
            if ($userView->getEmail()) {
                $user->setEmail($userView->getEmail());
            } else {
                throw new UnexpectedValueException('Element cannot be null -> email');
            }

            if ($userView->getUsername()) {
                $user->setUsername($userView->getUsername());
            } else {
                throw new UnexpectedValueException('Element cannot be null -> username');
            }

            if (!$userView->getPassword()) {
                throw new UnexpectedValueException('Element cannot be null -> password');
            }
        }

        if ($userView->getRoles()) {
            $user->setRoles($userView->getRoles());
        }

        if ($userView->getIsVerified()) {
            $user->setIsVerified($userView->getIsVerified());
        }

        if ($userView->getPassword()) {
            $password = $this->hasher->hashPassword($user, $userView->getPassword());
            $user->setPassword($password);
        }

        $this->em->persist($user);
    }
}
