<?php

namespace App\Admin\Application\Command\Graveyard;

use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Domain\Entity\Graveyard;
use Doctrine\ORM\EntityManagerInterface;

class GraveyardCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    public function __invoke(GraveyardCommand $command)
    {
        $graveyard = $command->getGraveyard();
        $this->em->persist($graveyard);
    }
}
