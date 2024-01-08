<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Core\Application\CQRS\Query\QueryInterface;
use App\Core\Domain\Entity\Grave;

interface GetGraveInterface extends QueryInterface
{
    public function execute(
        ?string $id
    ): Grave;
}
