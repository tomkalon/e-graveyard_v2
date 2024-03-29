<?php

namespace App\Admin\Application\Command\Person;

use App\Admin\Application\Service\Person\SavePersonServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;

class PersonCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly SavePersonServiceInterface $savePersonService,
    ) {
    }

    public function __invoke(PersonCommand $command)
    {
        $personView = $command->getPersonView();
        $this->savePersonService->persist($personView);
    }
}
