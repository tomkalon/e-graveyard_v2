<?php

namespace App\Admin\Application\Service\File\Grave;

use App\Admin\Application\Service\Upload\ImageUploaderServiceInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\FileExtensionTypeEnum;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\ValueObject\File\FileVo;
use Exception;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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
        $ext = FileExtensionTypeEnum::tryFrom($file->guessExtension())->value;
        $thumbExt = FileExtensionTypeEnum::WEBP->value;

        if ($ext) {
            $fileVo = new FileVo($name, $ext, $thumbExt);
        } else {
            $this->notification->addNotification('notification', new NotificationDto(
                'notification.file.create.label',
                NotificationTypeEnum::FAILED,
                'notification.file.create.invalid_extension_error',
            ));
            return null;
        }

        $imagePath = $this->getTargetDirectory() . '/';
        $thumbPath = $this->getTargetThumbnailDirectory() . '/';

        // save image and thumbnail to proper directory
        try {
            $file->move($this->getTargetDirectory(), $fileName);
            $manager = new ImageManager(new Driver());
            $image = $manager->read(file_get_contents($imagePath . $fileName));
            $image->cover(190, 150);
            $encoded = $image->toWebp(80);
            $encoded->save($thumbPath . $name . '.' . $thumbExt);
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
