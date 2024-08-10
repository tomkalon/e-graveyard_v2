<?php

namespace App\Admin\Application\Service\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Admin\Domain\View\User\UserView;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UpdateUserService implements UpdateUserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface     $userRepository,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly EntityManagerInterface      $em,
        private readonly NotificationInterface       $notification,
    ) {}

    public function update(UserView $userView): void
    {
        // handling save setting
        if (!$userView->getId()) {
            throw new InvalidArgumentException('User ID is required');
        } else {
            try {
                $user = $this->userRepository->find($userView->getId());
            } catch (Exception) {
                throw new InvalidArgumentException('Invalid ID format');
            }
            if (!$user) {
                throw new InvalidArgumentException('User not found');
            }
        }

        if ($userView->getEmail()) {
            $user->setEmail($userView->getEmail());
        }

        if ($userView->getUsername()) {
            $user->setUsername($userView->getUsername());
        }

        if ($userView->getPassword()) {
            $password = $this->hasher->hashPassword($user, $userView->getPassword());
            $user->setPassword($password);
        }

        if ($userView->getRoles()) {
            $user->setRoles($userView->getRoles());
        }

        // checks whether the entity is different from the one already saved in the database.
        $uow = $this->em->getUnitOfWork();
        $uow->computeChangeSets();
        $changeSet = $uow->getEntityChangeSet($user);

        if (empty($changeSet)) {
            // no changes notification
            $this->notification->addNotification('notification', new NotificationDto(
                'notification.user.update.label',
                NotificationTypeEnum::INFO,
                'notification.lifecycle.no_changes',
            ));
        } else {
            $this->em->persist($user);
        }
    }
}
