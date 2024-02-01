<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangeUserPasswordService implements ChangeUserPasswordServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface      $em,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly Security                    $security,
    )
    {
    }

    public function changePassword(UserView $userView): void
    {
        /** @var User $user */
        $user = $this->security->getUser();

        $password = $this->hasher->hashPassword($user, $userView->getPassword());
        $user->setPassword($password);
        $this->em->persist($user);
    }
}
