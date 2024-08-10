<?php

namespace App\Admin\Application\Command\Person;

use App\Core\Application\CQRS\Command\CommandInterface;

class RemovePersonCommand implements CommandInterface
{
    public function __construct(
        private readonly string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}
