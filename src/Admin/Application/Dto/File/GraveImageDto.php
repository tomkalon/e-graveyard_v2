<?php

namespace App\Admin\Application\Dto\File;

use App\Core\Domain\Entity\FileGrave;

class GraveImageDto
{
    public string $id;
    public string $name;
    public string $extension;
    public bool $isMainImage = false;

    public function __construct(
        string $id,
        string $name,
        string $extension,
        string $isMainImage,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->extension = $extension;
        $this->isMainImage = $isMainImage;
    }

    public static function fromEntity(FileGrave $file): self
    {
        return new self(
            $file->getId(),
            $file->getName(),
            $file->getExtension()->value,
            $file->isMainImage(),
        );
    }
}
