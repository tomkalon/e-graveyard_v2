<?php

namespace App\Admin\Infrastructure\QueryBus\Grave;

use App\Admin\Domain\Dto\Grave\GraveDto;
use App\Core\CQRS\QueryBus\QueryInterface;

class GetGravePaginatedQuery implements QueryInterface
{
    public function __construct(
        private readonly ?array $options = null
    ) {
    }
    public function getOptions(): ?array
    {
        return $this->options;
    }
}
