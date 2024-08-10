<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\User;

use App\Core\Application\CQRS\Command\CommandInterface;

readonly class RemoveUserCommand implements CommandInterface
{
    public function __construct(
        private string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}
