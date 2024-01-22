<?php

namespace App\Admin\Application\Command\Grave;

use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Grave;

class SetMainImageCommand implements CommandInterface
{
    public function __construct(
        private readonly Grave $grave,
        private readonly string $imageId
    ) {
    }

    public function getGrave(): Grave
    {
        return $this->grave;
    }

    public function getImageId(): string
    {
        return $this->imageId;
    }
}
