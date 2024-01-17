<?php

namespace App\Admin\Application\Command\Grave;

use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Grave;

class GraveCommand implements CommandInterface
{
    public function __construct(
        private readonly Grave $grave,
        private readonly ?array $images = null
    ) {
    }

    public function getGrave(): Grave
    {
        return $this->grave;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }
}
