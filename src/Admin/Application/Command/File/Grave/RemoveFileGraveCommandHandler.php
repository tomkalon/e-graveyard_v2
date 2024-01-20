<?php

namespace App\Admin\Application\Command\File\Grave;

use App\Admin\Domain\Repository\FileGraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Contracts\Translation\TranslatorInterface;

class RemoveFileGraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly FileGraveRepositoryInterface $fileGraveRepository,
        private readonly EntityManagerInterface       $em,
        private readonly NotificationInterface        $notification,
        private readonly TranslatorInterface          $translator
    ) {
    }

    public function __invoke(RemoveFileGraveCommand $command)
    {
        $image = null;

        try {
            $image = $this->fileGraveRepository->find($command->getId());
        } catch (Exception) {
            $this->notification->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.file.remove.label', [], 'flash'),
                NotificationTypeEnum::FAILED,
                $this->translator->trans('notification.paymentGrave.empty', [], 'flash')
            ));
        }

        if ($image) {
            $this->em->remove($image);
            $this->em->flush();
        }
    }
}
