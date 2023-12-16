<?php

namespace App\Admin\Infrastructure\CommandBus\Grave;

use App\Core\CQRS\CommandBus\CommandHandlerInterface;
use App\Core\Entity\Grave;
use Doctrine\ORM\EntityManagerInterface;

class CreateGraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    public function __invoke(CreateGraveCommand $command)
    {
        $dto = $command->getDto();

        $grave = new Grave();
        $grave->setGraveyard($dto->graveyard);
        $grave->setSector($dto->sector);
        $grave->setRow($dto->row);
        $grave->setNumber($dto->number);
        $grave->setPositionX($dto->positionX);
        $grave->setPositionY($dto->positionY);

        $this->em->persist($grave);
    }
}
