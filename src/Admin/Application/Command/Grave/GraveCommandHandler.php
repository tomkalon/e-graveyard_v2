<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Application\Services\Grave\GravePersistServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

class GraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly GravePersistServiceInterface $graveService
    ) {
    }

    public function __invoke(GraveCommand $command)
    {
        $grave = $command->getGrave();
        $this->graveService->persist($grave);
    }
}
