<?php

namespace App\Main\Infrastructure\Query\Frontpage;

use App\Main\Domain\View\Grave\GraveView;

interface GetGraveViewInterface
{
    public function execute(
        string $id,
    ): GraveView;
}
