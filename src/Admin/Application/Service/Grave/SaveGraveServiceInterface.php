<?php

namespace App\Admin\Application\Service\Grave;

use App\Core\Domain\Entity\Grave;

interface SaveGraveServiceInterface
{
    public function persist(Grave $grave): void;
}
