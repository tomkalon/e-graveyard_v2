<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Infrastructure\Repository;

use App\Core\Infrastructure\Repository\FileRepository as BaseFileRepository;
use App\Main\Domain\Repository\FileRepositoryInterface as BaseFileRepositoryInterface;

class FileRepository extends BaseFileRepository implements BaseFileRepositoryInterface {}
