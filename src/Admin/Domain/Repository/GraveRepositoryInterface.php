<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\Repository;

use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;
use Doctrine\ORM\Query;

interface GraveRepositoryInterface extends BaseGraveRepositoryInterface
{
    public function getGrave(string $id): Grave;

    public function getGravesListQuery(?GraveFilterView $filter): Query;
}
