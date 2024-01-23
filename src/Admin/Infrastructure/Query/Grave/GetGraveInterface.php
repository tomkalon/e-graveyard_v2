<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Core\Domain\Entity\Grave;

interface GetGraveInterface
{
    public function execute(string $id): Grave;
}
