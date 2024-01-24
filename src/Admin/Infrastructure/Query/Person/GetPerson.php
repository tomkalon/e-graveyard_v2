<?php

namespace App\Admin\Infrastructure\Query\Person;

use App\Admin\Domain\Repository\PersonRepositoryInterface;
use App\Core\Domain\Entity\Person;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetPerson implements GetPersonInterface
{
    public function __construct(
        private readonly PersonRepositoryInterface $personRepository
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function execute(?string $id): ?Person
    {
        try {
            $person = $this->personRepository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
        return $person;
    }
}
