<?php

namespace App\Admin\Application\Service\File\Grave;

use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Enum\FileExtensionTypeEnum;
use App\Core\Domain\ValueObject\File\FileVo;
use Doctrine\ORM\EntityManagerInterface;

class SaveImageService implements SaveFileGraveServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {
    }

    public function persist(FileVo $fileVo): FileGrave
    {
        $file = new FileGrave();
        $file->setName($fileVo->getName());
        $file->setExtension(FileExtensionTypeEnum::tryFrom($fileVo->getExtension()));
        $this->em->persist($file);
        return $file;
    }
}
