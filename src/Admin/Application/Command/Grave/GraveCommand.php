<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Grave;

class GraveCommand implements CommandInterface
{
    public function __construct(
        private readonly Grave $grave,
    ) {
    }

    public function getGrave(): Grave
    {
        return $this->grave;
    }

}
