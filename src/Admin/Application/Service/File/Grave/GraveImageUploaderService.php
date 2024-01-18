<?php

namespace App\Admin\Application\Service\File\Grave;

use App\Admin\Application\Service\File\ImageUploaderServiceInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\FileExtensionTypeEnum;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\ValueObject\File\FileVo;
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class GraveImageUploaderService implements ImageUploaderServiceInterface
{
    public function __construct(
        private readonly string           $targetDirectory,
        private readonly string           $targetThumbnailDirectory,
        private readonly SluggerInterface $slugger,
        private readonly NotificationInterface $notification,
    ) {
    }

    /**
     * @throws Exception
     */
    public function upload(UploadedFile $file): ?FileVo
    {
        // set fileName
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $name = $safeFilename.'-'.uniqid();

        $fileName = $name . '.' .$file->guessExtension();
        $ext = FileExtensionTypeEnum::tryFrom($file->guessExtension());

        if ($ext) {
            $fileVo = new FileVo($name, $ext->value);
        } else {
            $this->notification->addNotification('notification', new NotificationDto(
                'notification.file.create.label',
                NotificationTypeEnum::FAILED,
                'notification.file.create.invalid_extension_error',
            ));
            return null;
        }

        // save file to uploads directory and persist in database
        try {
            $file->move($this->getTargetDirectory(), $fileName);
            return $fileVo;
        } catch (FileException) {
            $this->notification->addNotification('notification', new NotificationDto(
                'notification.file.create.label',
                NotificationTypeEnum::FAILED,
                'notification.file.create.upload_error',
            ));
            return null;
        }
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }

    public function getTargetThumbnailDirectory(): string
    {
        return $this->targetThumbnailDirectory;
    }
}
