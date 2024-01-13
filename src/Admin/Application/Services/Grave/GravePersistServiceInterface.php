<?php

namespace App\Admin\Application\Services\Grave;

use App\Core\Domain\Entity\Grave;

interface GravePersistServiceInterface
{
    public function persist(Grave $grave): void;
}
