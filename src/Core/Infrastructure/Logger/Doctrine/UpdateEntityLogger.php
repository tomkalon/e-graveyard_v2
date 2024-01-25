<?php

namespace App\Core\Infrastructure\Logger\Doctrine;

class UpdateEntityLogger extends AbstractEntityLogger
{
    public function createMessage(object $entity): string
    {
        $username = $this->getLoggedUsername();
        $entityName = $this->getEntityName($entity);
        return sprintf('%s has been updated by %s', $entityName, $username);
    }
}
