<?php

namespace App\Admin\Application\Service\File;

use App\Core\Domain\ValueObject\File\FileVo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageUploaderServiceInterface extends UploaderServiceInterface
{
    public function getTargetThumbnailDirectory(): string;
}
