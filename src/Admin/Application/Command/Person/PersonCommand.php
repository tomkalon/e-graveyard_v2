<?php

namespace App\Admin\Application\Command\Person;

use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\Person;

class PersonCommand implements CommandInterface
{
    public function __construct(
        private readonly Person $person,
    ) {
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

}
