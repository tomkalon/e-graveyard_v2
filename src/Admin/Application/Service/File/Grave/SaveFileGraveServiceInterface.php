<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\File\Grave;

use App\Admin\Domain\ValueObject\File\FileVo;
use App\Core\Domain\Entity\FileGrave;

interface SaveFileGraveServiceInterface
{
    public function persist(FileVo $fileVo): FileGrave;
}
