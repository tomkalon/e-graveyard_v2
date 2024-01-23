<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Application\Service\Grave\SaveGraveServiceInterface;
use App\Admin\Domain\Repository\FileGraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Exception;
use Symfony\Contracts\Translation\TranslatorInterface;

class SetMainImageCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly FileGraveRepositoryInterface $fileGraveRepository,
        private readonly NotificationInterface        $notification,
        private readonly TranslatorInterface          $translator,
        private readonly SaveGraveServiceInterface    $saveGraveService
    ) {
    }

    public function __invoke(SetMainImageCommand $command)
    {
        $graveView = $command->getGraveView();

        try {
            $image = $this->fileGraveRepository->find($command->getImageId());
        } catch (Exception) {
            $image = null;
        }

        if (!$image) {
            $this->notification->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.grave.set_main_image.label', [], 'flash'),
                NotificationTypeEnum::FAILED,
                $this->translator->trans('notification.grave.set_main_image.empty', [], 'flash')
            ));
        } else {
            $graveView->setMainImage($image);
            $this->saveGraveService->persist($graveView);
        }
    }
}
