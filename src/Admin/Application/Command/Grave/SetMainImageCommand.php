<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Grave;

use App\Admin\Domain\View\Grave\GraveView;
use App\Core\Application\CQRS\Command\CommandInterface;

class SetMainImageCommand implements CommandInterface
{
    public function __construct(
        private readonly GraveView $graveView,
        private readonly string $imageId,
    ) {}

    public function getGraveView(): GraveView
    {
        return $this->graveView;
    }

    public function getImageId(): string
    {
        return $this->imageId;
    }
}
