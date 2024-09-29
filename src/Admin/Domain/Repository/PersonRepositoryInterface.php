<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\Repository;

use App\Admin\Domain\View\Person\PersonFilterView;
use App\Core\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use Doctrine\ORM\Query;

interface PersonRepositoryInterface extends BasePersonRepositoryInterface
{
    public function getPeopleListQuery(?PersonFilterView $filter): Query;
}
