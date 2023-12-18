<?php

namespace App\Core\CQRS\Query;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
