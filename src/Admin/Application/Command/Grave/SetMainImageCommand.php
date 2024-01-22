<?php

namespace App\Admin\Application\Command\Grave;

use App\Core\Application\CQRS\Command\CommandInterface;

class SetMainImageCommand implements CommandInterface
{
    public function __construct(
        private readonly string $id,
        private readonly string $imageId
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getImageId(): string
    {
        return $this->imageId;
    }
}
