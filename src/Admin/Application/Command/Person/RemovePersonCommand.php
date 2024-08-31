<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Person;

use App\Core\Application\CQRS\Command\CommandInterface;

readonly class RemovePersonCommand implements CommandInterface
{
    public function __construct(
        private string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}
