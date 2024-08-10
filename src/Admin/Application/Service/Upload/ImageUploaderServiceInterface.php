<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\Upload;

use App\Admin\Domain\ValueObject\File\FileVo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageUploaderServiceInterface
{
    public function upload(UploadedFile $file): ?FileVo;

    public function getTargetDirectory(): string;

    public function getTargetThumbnailDirectory(): string;
}
