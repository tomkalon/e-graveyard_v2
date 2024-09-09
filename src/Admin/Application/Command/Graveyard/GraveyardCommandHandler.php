<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Graveyard;

use App\Admin\Application\Service\Graveyard\SaveGraveyardServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

readonly class GraveyardCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SaveGraveyardServiceInterface $graveyardService,
    ) {}

    public function __invoke(GraveyardCommand $command)
    {
        $graveyardView = $command->getGraveyard();

        if ($graveyardView->getId()) {
            $this->graveyardService->update($graveyardView);
            return;
        }
        $this->graveyardService->create($graveyardView);
    }
}
