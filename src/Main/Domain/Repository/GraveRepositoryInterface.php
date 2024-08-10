<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Domain\Repository;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;

interface GraveRepositoryInterface extends BaseGraveRepositoryInterface
{
    public function getGrave(string $id): Grave;
}
