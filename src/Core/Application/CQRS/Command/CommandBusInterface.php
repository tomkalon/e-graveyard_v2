<?php

namespace App\Core\Application\CQRS\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
