<?php

namespace App\Admin\Infrastructure\Query\Person;

use App\Admin\Application\Dto\Person\PersonDto;
use App\Core\Application\CQRS\Query\QueryInterface;

interface GetPersonInterface extends QueryInterface
{
    public function execute(
        ?string $id
    ): PersonDto;
}
