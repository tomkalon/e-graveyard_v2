<?php

namespace App\Admin\Domain\Repository;

use App\Core\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use Doctrine\ORM\Query;

interface GraveRepositoryInterface extends BaseGraveRepositoryInterface
{
    public function getGravesListQuery(): Query;
}
