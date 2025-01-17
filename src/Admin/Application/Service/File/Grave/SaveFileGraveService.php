<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\File\Grave;

use App\Admin\Domain\ValueObject\File\FileVo;
use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\Enum\FileExtensionTypeEnum;
use Doctrine\ORM\EntityManagerInterface;

class SaveFileGraveService implements SaveFileGraveServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {}

    public function persist(FileVo $fileVo): FileGrave
    {
        $file = new FileGrave();
        $file->setName($fileVo->getName());
        $file->setExtension(FileExtensionTypeEnum::tryFrom($fileVo->getExtension()));
        $this->em->persist($file);
        return $file;
    }
}
