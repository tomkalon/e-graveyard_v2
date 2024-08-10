<?php

namespace App\Admin\Application\Service\File\Grave;

use App\Admin\Application\Service\Upload\ImageUploaderServiceInterface;
use App\Admin\Domain\ValueObject\File\FileVo;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\FileExtensionTypeEnum;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Exception;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

readonly class GraveImageUploaderService implements ImageUploaderServiceInterface
{
    public function __construct(
        private string                $targetDirectory,
        private string                $targetThumbnailDirectory,
        private string                $maxImageWidth,
        private string                $maxImageHeight,
        private SluggerInterface      $slugger,
        private NotificationInterface $notification,
    ) {}

    /**
     * @throws Exception
     */
    public function upload(UploadedFile $file): ?FileVo
    {
        // set fileName
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $name = $safeFilename . '-' . uniqid();

        $fileName = $name . '.' . $file->guessExtension();
        $ext = FileExtensionTypeEnum::WEBP->value;

        $imageDirectory = $this->getTargetDirectory() . '/';
        $thumbDirectory = $this->getTargetThumbnailDirectory() . '/';
        $imagePath = $imageDirectory . $fileName;

        // save image and thumbnail to proper directory
        try {
            $file->move($this->getTargetDirectory(), $fileName);

            $filesystem = new Filesystem();
            $readFile = file_get_contents($imagePath);
            if ($filesystem->exists($imagePath)) {
                $filesystem->remove($imagePath);
            }

            $manager = new ImageManager(new Driver());
            $originalImage = $manager->read($readFile);

            $image = $originalImage->scale($this->maxImageWidth, $this->maxImageHeight)->toWebp();
            $image->save($imageDirectory . $name . '.' . $ext);

            $thumb = $originalImage->cover(190, 150);
            $encoded = $thumb->toWebp();
            $encoded->save($thumbDirectory . $name . '.' . $ext);

            return new FileVo($name, $ext);
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
