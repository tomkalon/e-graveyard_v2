<?php

namespace App\Main\Infrastructure\Repository;

use App\Core\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use App\Main\Domain\View\DeceasedSearchView;
use Doctrine\ORM\Query;

interface PersonRepositoryInterface extends BasePersonRepositoryInterface
{
    public function getPersonListQuery(DeceasedSearchView $searchView): Query;
}
