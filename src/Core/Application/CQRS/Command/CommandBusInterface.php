<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\CQRS\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
