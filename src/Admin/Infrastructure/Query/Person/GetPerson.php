<?php

namespace App\Admin\Infrastructure\Query\Person;

use App\Admin\Application\Dto\Person\PersonDto;
use App\Admin\Domain\Repository\PersonRepositoryInterface;

class GetPerson implements GetPersonInterface
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository
    ) {
    }

    public function execute(?string $id): PersonDto
    {
        return PersonDto::fromEntity($this->personRepository->find($id));
    }
}
