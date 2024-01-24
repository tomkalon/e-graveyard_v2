<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Domain\View\Grave\GraveView;
use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Grave;

class GraveCommand implements CommandInterface
{
    public function __construct(
        private readonly GraveView $graveView,
        private readonly ?array $images = null
    ) {
    }

    public function getGrave(): GraveView
    {
        return $this->graveView;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }
}
