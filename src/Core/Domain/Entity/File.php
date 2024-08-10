<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Entity;

use App\Core\Domain\Enum\FileExtensionTypeEnum;
use App\Core\Domain\Trait\IdTrait;
use App\Core\Domain\Trait\LifecycleTrait;
use Ramsey\Uuid\Uuid;

class File
{
    use IdTrait;
    use LifecycleTrait;

    protected string $name;
    private FileExtensionTypeEnum $extension;

    public function __construct(?string $name = null)
    {
        $this->id = Uuid::uuid4();
        if ($name) {
            $this->name = $name;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getExtension(): FileExtensionTypeEnum
    {
        return $this->extension;
    }

    public function setExtension(FileExtensionTypeEnum $extension): void
    {
        $this->extension = $extension;
    }

    public function getFilename(): string
    {
        return $this->name . '.' . $this->extension->value;
    }
}
