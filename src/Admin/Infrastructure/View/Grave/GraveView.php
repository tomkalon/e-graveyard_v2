<?php

namespace App\Admin\Infrastructure\View\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Domain\Entity\Person;
use App\Core\Infrastructure\View\ViewInterface;

class GraveView implements ViewInterface
{
    /** @var $data GraveDto */
    public function getView(mixed $data, $format = null, $context = null): array
    {
        return [
            'sector' => $data->sector,
            'row' => $data->row,
            'number' => $data->number,
            'graveyard' => $data->graveyard->getName(),
            'payment' => $data->payments,
            'people' => array_map(function ($person) {

                /** @var Person $person */
                return [
                    'firstname' => $person->getFirstname(),
                    'lastname' => $person->getLastName(),
                    'born_date' => $person->getBornDate()->format('Y-m-d'),
                    'death_date' => $person->getDeathDate()->format('Y-m-d')
                ];
            }, $data->people)
        ];
    }
}
