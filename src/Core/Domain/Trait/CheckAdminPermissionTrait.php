<?php

namespace App\Core\Domain\Trait;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\Enum\UserRoleEnum;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

trait CheckAdminPermissionTrait
{
    public function __construct(private readonly UrlGeneratorInterface $urlGenerator,
                                private readonly NotificationInterface $notification,
                                private readonly Security $security
    )
    {
    }

    public function isAdmin(): ?RedirectResponse
    {
        $roles = $this->security->getUser()->getRoles();
        if (!in_array(UserRoleEnum::ADMIN->value, $roles)) {
            $this->notification->addNotification('flash', new NotificationDto(
                    'notification.user.login.title',
                    NotificationTypeEnum::FAILED,
                    'notification.user.login.failed.no_permission',
                )
            );
        }

        if (in_array(UserRoleEnum::MANAGER->value, $roles)) {
            $url = $this->urlGenerator->generate('admin_web_user_index');
            return new RedirectResponse($url);
        }

        if (in_array(UserRoleEnum::USER->value, $roles)) {
            $this->notification->addNotification('flash', new NotificationDto(
                    'notification.user.login.title',
                    NotificationTypeEnum::FAILED,
                    'notification.user.login.failed.no_permission',
                )
            );
            $url = $this->urlGenerator->generate('main_web_index');
            return new RedirectResponse($url);

        }

        if (!in_array(UserRoleEnum::USER->value, $roles)) {
            $url = $this->urlGenerator->generate('main_web_index');
            return new RedirectResponse($url);
        }

        return null;
    }
}
