<?php

namespace App\Admin\Application\Service\Upload;

interface ImageUploaderServiceInterface extends UploaderServiceInterface
{
    public function getTargetThumbnailDirectory(): string;
}
