<?php

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\PersonRepositoryInterface as BasePersonRepositoryInterface;
use App\Core\Infrastructure\Repository\PersonRepository as BasePersonRepository;

class PersonRepository extends BasePersonRepository implements BasePersonRepositoryInterface
{
}
