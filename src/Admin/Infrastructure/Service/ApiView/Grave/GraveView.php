<?php

namespace App\Admin\Infrastructure\Service\ApiView\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Domain\Entity\Person;
use App\Core\Infrastructure\Service\ApiView\ViewInterface;

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
            'people' => array_map(function($person) {

                /** @var Person $person */
                return [
                    'firstName' => $person->getFirstname(),
                    'lastName' => $person->getLastName(),
                    'bornDate' => $person->getBornDate()->format('Y-m-d'),
                    'deathDate' => $person->getDeathDate()->format('Y-m-d')
                ];
            }, $data->people)
        ];
    }
}
