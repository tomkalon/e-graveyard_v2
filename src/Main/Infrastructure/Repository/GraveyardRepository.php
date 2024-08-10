<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Infrastructure\Repository;

use App\Core\Infrastructure\Repository\GraveyardRepository as BaseGraveyardRepository;
use App\Main\Domain\Repository\GraveyardRepositoryInterface as BaseGraveyardRepositoryInterface;

class GraveyardRepository extends BaseGraveyardRepository implements BaseGraveyardRepositoryInterface {}
