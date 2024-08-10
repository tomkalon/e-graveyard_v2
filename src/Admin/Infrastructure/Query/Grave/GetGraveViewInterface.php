<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\View\Grave\GraveView;

interface GetGraveViewInterface
{
    public function execute(
        string $id,
    ): GraveView;
}
