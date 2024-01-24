<?php

namespace App\Core\Application\Service\File;

use App\Core\Domain\Entity\File;

interface RemoveFileServiceInterface
{
    public function remove(File $file, string $directory, ?string $thumbnailDirectory = null): bool;
}
