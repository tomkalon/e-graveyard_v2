<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Domain\Repository;

use App\Core\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use App\Main\Domain\View\Search\DeceasedSearchView;
use Doctrine\ORM\Query;

interface PersonRepositoryInterface extends BasePersonRepositoryInterface
{
    public function getPersonListQuery(DeceasedSearchView $searchView): Query;
}
