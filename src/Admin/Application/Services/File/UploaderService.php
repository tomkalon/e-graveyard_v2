<?php

namespace App\Admin\Application\Services\File;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\File;
use App\Core\Domain\Enum\FileExtensionTypeEnum;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploaderService implements UploaderServiceInterface
{

    public function __construct(
        private readonly string           $targetDirectory,
        private readonly SluggerInterface $slugger,
        private readonly NotificationInterface $notification,
        private readonly EntityManagerInterface $em,
    ) {
    }

    /**
     * @throws Exception
     */
    public function upload(UploadedFile $file): ?File
    {
        // set fileName
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        // create new File
        $newFile = new File();
        $newFile->setName($safeFilename.'-'.uniqid());

        $ext = FileExtensionTypeEnum::tryFrom($file->guessExtension());
        if ($ext) {
            $newFile->setExtension($ext);
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
            $this->em->persist($newFile);
            return $newFile;
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
}
