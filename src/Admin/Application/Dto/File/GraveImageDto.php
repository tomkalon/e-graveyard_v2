<?php

namespace App\Admin\Application\Dto\File;

use App\Core\Domain\Entity\FileGrave;

class GraveImageDto
{
    public string $id;
    public string $name;
    public string $extension;

    public function __construct(
        string $id,
        string $name,
        string $extension,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->extension = $extension;
    }

    public static function fromEntity(FileGrave $file): self
    {
        return new self(
            $file->getId(),
            $file->getName(),
            $file->getExtension()->value,
        );
    }
}
