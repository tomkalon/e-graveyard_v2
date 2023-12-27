<?php

namespace App\Admin\Domain\Repository;

use App\Core\Domain\Repository\GraveyardRepositoryInterface as BaseGraveyardRepositoryInterface;
use Doctrine\ORM\Query;

interface GraveyardRepositoryInterface extends BaseGraveyardRepositoryInterface
{
    public function getGraveyardListQuery(): Query;
}
