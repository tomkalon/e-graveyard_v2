<?php

namespace App\Admin\Application\Command\Person;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Domain\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

class PersonCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly GraveRepositoryInterface $graveRepository
    )
    {
    }

    public function __invoke(PersonCommand $command)
    {
        $person = new Person();
        $dto = $command->getDto();

        $grave = $this->graveRepository->find($dto->grave);

        $person->setFirstname($dto->firstName);
        $person->setLastname($dto->lastName);
        $person->setBornDate($dto->bornDate);
        $person->setDeathDate($dto->deathDate);
        $person->setGrave($grave);

        $this->em->persist($person);
    }
}
