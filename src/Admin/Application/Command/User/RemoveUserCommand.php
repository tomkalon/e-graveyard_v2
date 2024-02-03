<?php

namespace App\Admin\Application\Command\User;

use App\Core\Application\CQRS\Command\CommandInterface;

class RemoveUserCommand implements CommandInterface
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
