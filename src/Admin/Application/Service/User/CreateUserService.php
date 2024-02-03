<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use UnexpectedValueException;

class CreateUserService implements CreateUserServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface      $em,
        private readonly UserPasswordHasherInterface $hasher,
    ) {
    }

    public function persist(UserView $userView, ?bool $isSendEmail = false): void
    {

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

        if ($userView->getPassword()) {
            $password = $this->hasher->hashPassword($user, $userView->getPassword());
            $user->setPassword($password);
        }

        if ($userView->getRoles()) {
            $user->setRoles($userView->getRoles());
        }

        if ($userView->getIsVerified()) {
            $user->setIsVerified($userView->getIsVerified());
        }

        $this->em->persist($user);
    }
}
