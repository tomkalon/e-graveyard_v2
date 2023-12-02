<?php

namespace App\Core\CQRS\QueryBus;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
