<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Application\Dto\File\GraveImageDto;
use App\Core\Application\CQRS\Query\QueryInterface;

interface GetImagesDtoInterface extends QueryInterface
{
    public function execute(
        ?string $id
    ): array;
}
