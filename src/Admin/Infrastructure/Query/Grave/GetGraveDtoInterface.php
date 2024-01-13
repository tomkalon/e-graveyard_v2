<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Application\CQRS\Query\QueryInterface;

interface GetGraveDtoInterface extends QueryInterface
{
    public function execute(
        ?string $id
    ): GraveDto;
}
