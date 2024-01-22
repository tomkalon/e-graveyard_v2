<?php

namespace App\Admin\Application\Command\Grave;

use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Grave;

class RemoveGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly Grave $grave
    ) {
    }

    public function getGrave(): Grave
    {
        return $this->grave;
    }
}
