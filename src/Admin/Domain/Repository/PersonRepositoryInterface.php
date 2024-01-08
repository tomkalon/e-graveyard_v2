<?php

namespace App\Admin\Domain\Repository;

use App\Core\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use Doctrine\ORM\Query;

interface PersonRepositoryInterface extends BasePersonRepositoryInterface
{
    public function getPeopleListQuery(): Query;
}
