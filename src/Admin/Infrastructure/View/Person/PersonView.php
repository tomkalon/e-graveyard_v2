<?php

namespace App\Admin\Infrastructure\View\Person;

use App\Admin\Application\Dto\Person\PersonDto;
use App\Core\Infrastructure\View\ViewInterface;

class PersonView implements ViewInterface
{

    /** @var PersonDto $data */
    public function getView(mixed $data, $format = null, $context = null): array
    {
        return [
            'firstname' => $data->firstName,
            'lastname' => $data->lastName,
            'born_date' => $data->bornDate->format('Y-m-d'),
            'death_date' => $data->deathDate->format('Y-m-d'),
            'grave_id' => $data->grave->getId(),
        ];
    }
}
