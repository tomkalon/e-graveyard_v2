<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\FileGraveRepositoryInterface as BaseFileGraveRepositoryInterface;
use App\Core\Infrastructure\Repository\FileGraveRepository as BaseFileGraveRepository;

class FileGraveRepository extends BaseFileGraveRepository implements BaseFileGraveRepositoryInterface {}
