<?php

namespace App\Core\Domain\ValueObject\File;

class FileVo
{
    private string $name;
    private string $extension;
    private ?string $thumbnail_extension;

    public function __construct(string $name, string $extension, ?string $thumbnail_extension = null)
    {
        $this->name = $name;
        $this->extension = $extension;
        $this->thumbnail_extension = $thumbnail_extension;
    }

    public function equals(FileVo $fileVo): bool
    {
        return $this->name === $fileVo->name && $this->extension === $fileVo->extension;
    }

    public function getFile(): string
    {
        return $this->name. '.' .$this->extension;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getThumbnailExtension(): string
    {
        return $this->thumbnail_extension;
    }
}
