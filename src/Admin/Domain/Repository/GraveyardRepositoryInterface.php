<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\Repository;

use App\Core\Domain\Repository\GraveyardRepositoryInterface as BaseGraveyardRepositoryInterface;
use Doctrine\ORM\Query;

interface GraveyardRepositoryInterface extends BaseGraveyardRepositoryInterface
{
    public function getGraveyardsListQuery(): Query;
    public function getGraveyardsPeopleNumber(): array;
}
