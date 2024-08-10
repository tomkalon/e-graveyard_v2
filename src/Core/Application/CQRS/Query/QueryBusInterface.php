<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\CQRS\Query;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
