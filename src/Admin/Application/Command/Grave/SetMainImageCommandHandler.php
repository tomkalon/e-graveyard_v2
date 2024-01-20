<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Domain\Repository\FileGraveRepositoryInterface;
use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Contracts\Translation\TranslatorInterface;

class SetMainImageCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface     $graveRepository,
        private readonly FileGraveRepositoryInterface $fileGraveRepository,
        private readonly NotificationInterface        $notification,
        private readonly TranslatorInterface          $translator,
        private readonly EntityManagerInterface       $em
    )
    {
    }

    public function __invoke(SetMainImageCommand $command)
    {
        $grave = null;
        $image = null;

        try {
            $grave = $this->graveRepository->find($command->getId());
            $image = $this->fileGraveRepository->find($command->getImageId());
        } catch (Exception) {
            $this->notification->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.grave.set_main_image.label', [], 'flash'),
                NotificationTypeEnum::FAILED,
                $this->translator->trans('notification.grave.set_main_image.empty', [], 'flash')
            ));
        }

        if ($grave and $image) {
            $currentImage = $grave->getMainImage();

            if ($currentImage) {
                $grave->addImages($currentImage);
            }

            $grave->removeImage($image);
            $grave->setMainImage($image);

            $this->em->persist($grave);
        }
    }
}
