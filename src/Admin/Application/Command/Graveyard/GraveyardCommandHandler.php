<?php

namespace App\Admin\Application\Command\Graveyard;

use App\Admin\Application\Service\Graveyard\SaveGraveyardServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

class GraveyardCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly SaveGraveyardServiceInterface $graveyardService
    )
    {
    }

    public function __invoke(GraveyardCommand $command)
    {
        $graveyardView = $command->getGraveyard();
        $this->graveyardService->persist($graveyardView);
    }
}
