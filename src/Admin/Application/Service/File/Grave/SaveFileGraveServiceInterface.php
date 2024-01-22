<?php

namespace App\Admin\Application\Service\File\Grave;

use App\Core\Domain\Entity\FileGrave;
use App\Core\Domain\ValueObject\File\FileVo;

interface SaveFileGraveServiceInterface
{
    public function persist(FileVo $fileVo): FileGrave;
}
