<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\Graveyard;

use App\Admin\Domain\View\Graveyard\GraveyardView;

interface SaveGraveyardServiceInterface
{
    public function create(GraveyardView $graveyardView): void;
    public function update(GraveyardView $graveyardView): void;
}
