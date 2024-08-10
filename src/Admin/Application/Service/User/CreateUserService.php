<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use UnexpectedValueException;

readonly class CreateUserService implements CreateUserServiceInterface
{
    public function __construct(
        private EntityManagerInterface      $em,
        private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function persist(UserView $userView): void
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

        $this->em->persist($user);
        $this->em->flush();
    }
}
