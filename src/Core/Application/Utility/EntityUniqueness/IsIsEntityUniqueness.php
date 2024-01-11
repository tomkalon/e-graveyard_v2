<?php

namespace App\Core\Application\Utility\EntityUniqueness;

use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

class IsIsEntityUniqueness implements IsEntityUniquenessInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    public function isUnique (object $entity): bool
    {

        if (!$this->em->contains($entity)) {
            throw new InvalidArgumentException(sprintf('Invalid argument exception. You have entered a variable of type: %s. Expected variable type: %s', gettype($entity), 'EntityManager::class'));
        }

        $uow = $this->em->getUnitOfWork();
        $uow->computeChangeSets();
        $changeSet = $uow->getEntityChangeSet($entity);

        if (empty($changeSet)) {
            return false;
        }
        return true;
    }
}
