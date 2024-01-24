<?php

namespace App\Admin\Application\Service\Graveyard;

use App\Admin\Domain\View\Graveyard\GraveyardView;

interface SaveGraveyardServiceInterface
{
    public function persist(GraveyardView $graveyardView): void;
}
