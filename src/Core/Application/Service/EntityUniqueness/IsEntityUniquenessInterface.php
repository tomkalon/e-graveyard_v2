<?php

namespace App\Core\Application\Service\EntityUniqueness;

use Doctrine\ORM\EntityManagerInterface;

interface IsEntityUniquenessInterface
{
    public function isUnique (object $entity): bool;
}
