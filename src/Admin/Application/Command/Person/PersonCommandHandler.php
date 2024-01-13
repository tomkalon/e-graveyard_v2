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
    ) {
    }

    public function __invoke(PersonCommand $command)
    {
        $person = $command->getPerson();
        $this->em->persist($person);
    }
}
