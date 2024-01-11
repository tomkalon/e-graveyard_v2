<?php

namespace App\Core\Application\Utility\EntityUniqueness;

interface IsEntityUniquenessInterface
{
    public function isUnique (object $entity): bool;
}
