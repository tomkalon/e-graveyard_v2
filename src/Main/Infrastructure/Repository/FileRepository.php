<?php

namespace App\Main\Infrastructure\Repository;

use App\Main\Domain\Repository\FileRepositoryInterface as BaseFileRepositoryInterface;
use App\Core\Repository\FileRepository as BaseFileRepository;

class FileRepository extends BaseFileRepository implements BaseFileRepositoryInterface
{
}
