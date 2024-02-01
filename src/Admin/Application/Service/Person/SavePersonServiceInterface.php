<?php

namespace App\Admin\Application\Service\Person;

use App\Admin\Domain\View\Person\PersonView;

interface SavePersonServiceInterface
{
    public function persist(PersonView $personView): void;
}
