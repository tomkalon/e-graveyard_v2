<?php

namespace App\Admin\Infrastructure\Query\Person;

use App\Admin\Domain\Repository\PersonRepositoryInterface;
use App\Core\Domain\Entity\Person;

class GetPerson implements GetPersonInterface
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository
    ) {
    }

    public function execute(?string $id): Person
    {
        return $this->personRepository->find($id);
    }
}
