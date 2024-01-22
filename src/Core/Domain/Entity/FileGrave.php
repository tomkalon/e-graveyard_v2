<?php

namespace App\Core\Domain\Entity;

use App\Core\Domain\Enum\FileExtensionTypeEnum;

class FileGrave extends File
{
    private ?Grave $grave_gallery = null;
    private ?Grave $grave_main_image;

    public function getGrave(): Grave
    {
        return $this->grave_gallery;
    }

    public function setGrave(?Grave $grave = null): void
    {
        $this->grave_gallery = $grave;
    }

    public function getGraveMainImage(): ?Grave
    {
        return $this->grave_main_image;
    }

    public function setGraveMainImage(?Grave $grave_main_image = null): void
    {
        $this->grave_main_image = $grave_main_image;
    }
}
