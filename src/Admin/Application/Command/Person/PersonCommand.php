<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Person;

use App\Admin\Domain\View\Person\PersonView;
use App\Core\Application\CQRS\Command\CommandInterface;

readonly class PersonCommand implements CommandInterface
{
    public function __construct(
        private PersonView $personView,
    ) {}

    public function getPersonView(): PersonView
    {
        return $this->personView;
    }
}
