<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\FileRepositoryInterface as BaseFileRepositoryInterface;
use App\Core\Infrastructure\Repository\FileRepository as BaseFileRepository;

class FileRepository extends BaseFileRepository implements BaseFileRepositoryInterface
{
}
