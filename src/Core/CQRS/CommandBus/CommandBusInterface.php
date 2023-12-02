<?php

namespace App\Core\CQRS\CommandBus;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
