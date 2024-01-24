<?php

namespace App\Admin\Domain\Repository;

use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Core\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use Doctrine\ORM\Query;

interface GraveRepositoryInterface extends BaseGraveRepositoryInterface
{
    public function getGravesListQuery(?GraveFilterView $filter): Query;
}
