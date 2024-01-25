<?php

namespace App\Core\Infrastructure\Logger\Doctrine;

class RemoveEntityLogger extends AbstractEntityLogger
{
    public function createMessage(object $entity): string
    {
        $username = $this->getLoggedUsername();
        $entityName = $this->getEntityName($entity);
        return sprintf('%s has been removed by %s', $entityName, $username);
    }
}
