<?php

namespace App\Admin\Application\Command\Grave;

use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Grave;

class RemoveGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly string $graveId
    ) {
    }

    public function getGraveId(): string
    {
        return $this->graveId;
    }
}
