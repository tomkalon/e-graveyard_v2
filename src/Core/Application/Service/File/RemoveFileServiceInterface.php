<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\Service\File;

use App\Core\Domain\Entity\File;

interface RemoveFileServiceInterface
{
    public function remove(File $file, string $directory, ?string $thumbnailDirectory = null): bool;
}
