<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Person;

use App\Admin\Application\Service\Person\SavePersonServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

readonly class PersonCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SavePersonServiceInterface $savePersonService,
    ) {}

    public function __invoke(PersonCommand $command)
    {
        $personView = $command->getPersonView();
        $this->savePersonService->persist($personView);
    }
}
