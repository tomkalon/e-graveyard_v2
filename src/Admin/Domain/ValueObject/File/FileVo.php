<?php

namespace App\Admin\Domain\ValueObject\File;

class FileVo
{
    private string $name;
    private string $extension;

    public function __construct(string $name, string $extension)
    {
        $this->name = $name;
        $this->extension = $extension;
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
}
