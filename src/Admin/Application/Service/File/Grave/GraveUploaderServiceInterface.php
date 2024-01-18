<?php

namespace App\Admin\Application\Service\File\Grave;

use App\Core\Domain\Entity\FileGrave;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface GraveUploaderServiceInterface
{
    public function upload(UploadedFile $file): ?FileGrave;

    public function getTargetDirectory(): string;
}
