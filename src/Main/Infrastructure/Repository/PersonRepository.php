<?php

namespace App\Main\Infrastructure\Repository;

use App\Main\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use App\Core\Repository\PersonRepository as BasePersonRepository;

class PersonRepository extends BasePersonRepository implements BasePersonRepositoryInterface
{
}
