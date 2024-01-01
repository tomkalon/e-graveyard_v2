<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Symfony\Contracts\Translation\TranslatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class RemoveGraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly NotificationInterface $notification,
        private readonly TranslatorInterface $translator
    )
    {
    }

    public function __invoke(RemoveGraveCommand $command)
    {
        $grave = $this->graveRepository->find($command->getId());

        if ($grave) {
            $this->em->remove($grave);
            $this->em->flush();
        } else {
            $this->notification->addNotification('notification', new NotificationDto(
                    $this->translator->trans('notification.entity.grave', [], 'flash'),
                    NotificationTypeEnum::FAILED,
                    $this->translator->trans('notification.grave.empty', [], 'flash')
                )
            );
        }
    }
}
