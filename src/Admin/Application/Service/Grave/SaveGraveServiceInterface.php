<?php

namespace App\Admin\Application\Service\Grave;

use App\Admin\Domain\View\Grave\GraveView;

interface SaveGraveServiceInterface
{
    public function persist(GraveView $graveView): void;
}
