<?php

namespace App\Admin\Application\Services\File;

use App\Core\Domain\Entity\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploaderServiceInterface
{
    public function upload(UploadedFile $file): ?File;

    public function getTargetDirectory(): string;
}
