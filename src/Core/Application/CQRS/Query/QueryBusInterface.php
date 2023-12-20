<?php

namespace App\Core\Application\CQRS\Query;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
