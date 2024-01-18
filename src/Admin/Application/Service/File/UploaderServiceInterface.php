<?php

namespace App\Admin\Application\Service\File;

use App\Core\Domain\ValueObject\File\FileVo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploaderServiceInterface
{
    public function upload(UploadedFile $file): ?FileVo;

    public function getTargetDirectory(): string;
}
