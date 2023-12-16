<?php

namespace App\Admin\Infrastructure\Repository;

use App\Core\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use Doctrine\ORM\Query;

interface GraveRepositoryInterface extends BaseGraveRepositoryInterface
{
    public function getGraveListQuery(): Query;
}
