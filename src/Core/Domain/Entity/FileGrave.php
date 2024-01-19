<?php

namespace App\Core\Domain\Entity;

use App\Core\Domain\Enum\FileExtensionTypeEnum;

class FileGrave extends File
{
    private ?Grave $grave = null;
    private FileExtensionTypeEnum $thumbnail_extension;

    public function getGrave(): ?Grave
    {
        return $this->grave;
    }

    public function setGrave(?Grave $grave = null): void
    {
        $this->grave = $grave;
    }

    public function getThumbnailExtension(): FileExtensionTypeEnum
    {
        return $this->thumbnail_extension;
    }

    public function setThumbnailExtension(FileExtensionTypeEnum $thumbnail_extension): void
    {
        $this->thumbnail_extension = $thumbnail_extension;
    }
}
