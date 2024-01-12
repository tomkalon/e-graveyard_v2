<?php

namespace App\Core\Application\Utility\EntityUniqueness;

interface HasEntityChangedInterface
{
    public function hasChanged(object $entity): bool;
}
