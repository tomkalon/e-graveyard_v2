<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;
use Doctrine\ORM\EntityManagerInterface;

class RemoveGraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly EntityManagerInterface $em,
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function __invoke(RemoveGraveCommand $command)
    {
        try {
            $grave = $this->graveRepository->find($command->getGraveId());
            $this->em->remove($grave);
            $this->em->flush();
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
