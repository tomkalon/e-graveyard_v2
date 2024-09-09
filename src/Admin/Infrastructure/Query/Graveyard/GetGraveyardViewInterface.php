<?php

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Admin\Domain\View\Graveyard\GraveyardView;

interface GetGraveyardViewInterface
{
    public function execute(string $id): ?GraveyardView;

}
