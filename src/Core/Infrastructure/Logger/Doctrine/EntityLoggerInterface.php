<?php

namespace App\Core\Infrastructure\Logger\Doctrine;

interface EntityLoggerInterface
{
    public function logEvent(object $entity): void;
}
