<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Core\Domain\Entity\Graveyard;

interface GetGraveyardInterface
{
    public function execute(string $id): ?Graveyard;
}
