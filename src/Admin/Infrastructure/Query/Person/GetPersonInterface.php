<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Person;

use App\Core\Application\CQRS\Query\QueryInterface;
use App\Core\Domain\Entity\Person;

interface GetPersonInterface extends QueryInterface
{
    public function execute(
        ?string $id,
    ): ?Person;
}
