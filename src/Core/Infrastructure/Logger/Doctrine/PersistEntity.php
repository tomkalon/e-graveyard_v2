<?php

namespace App\Core\Infrastructure\Logger\Doctrine;

class PersistEntity extends AbstractEntityLogger
{
    public function createMessage(object $entity): string
    {
        $username = $this->getLoggedUsername();
        $entityName = $this->getEntityName($entity);
        return sprintf('%s has been created by %s', $entityName, $username);
    }
}
