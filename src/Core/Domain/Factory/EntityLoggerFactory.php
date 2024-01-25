<?php

namespace App\Core\Domain\Factory;

use App\Core\Infrastructure\Logger\Doctrine\EntityLoggerInterface;

class EntityLoggerFactory
{
    public function createLogger(string $context): EntityLoggerInterface
    {
        if ($context === 'update') {
            return new UpdateEntityLogger();
        } elseif ($context === 'persist') {
            return new PersistEntityLogger();
        } else {
            throw new \InvalidArgumentException('Invalid context');
        }
    }
}
