<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Person;

use App\Admin\Domain\Repository\PersonRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class RemovePersonCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly PersonRepositoryInterface $personRepository,
    ) {}

    /**
     * @throws EntityNotFoundException
     */
    public function __invoke(RemovePersonCommand $command)
    {
        try {
            $person = $this->personRepository->find($command->getId());
            if ($person) {
                $this->em->remove($person);
                $this->em->flush();
            } else {
                throw new EntityNotFoundException();
            }
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
