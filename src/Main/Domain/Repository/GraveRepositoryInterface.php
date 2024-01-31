<?php

namespace App\Main\Domain\Repository;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Repository\GraveRepositoryInterface as BaseGraveRepositoryInterface;

interface GraveRepositoryInterface extends BaseGraveRepositoryInterface
{
    public function getGrave(string $id): Grave;
}
