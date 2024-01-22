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
        private readonly FileGraveRepositoryInterface $fileGraveRepository,
        private readonly NotificationInterface        $notification,
        private readonly TranslatorInterface          $translator,
        private readonly EntityManagerInterface       $em
    ) {
    }

    public function __invoke(SetMainImageCommand $command)
    {
        $grave = $command->getGrave();
        $image = null;

        try {
            $image = $this->fileGraveRepository->find($command->getImageId());
        } catch (Exception) {
            $this->notification->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.grave.set_main_image.label', [], 'flash'),
                NotificationTypeEnum::FAILED,
                $this->translator->trans('notification.grave.set_main_image.empty', [], 'flash')
            ));
        }

        if ($image) {
            $currentImage = $grave->getMainImage();
            $grave->setMainImage($image);

            if ($currentImage) {
                $grave->addImages($currentImage);
                $image->setGrave();
            }

            $this->em->persist($grave);
        }
    }
}
