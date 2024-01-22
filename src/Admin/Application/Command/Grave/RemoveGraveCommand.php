<?php

namespace App\Admin\Application\Command\Grave;

use App\Core\Application\CQRS\Command\CommandInterface;

class RemoveGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly string $id
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
