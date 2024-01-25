<?php

namespace App\Core\Infrastructure\Logger\Doctrine;

class UpdateEntityLogger extends AbstractEntityLogger
{
    public function createMessage(object $entity): string
    {
        $username = $this->getLoggedUsername();
        $itemData = $this->getItemData($entity);
        $entityName = $this->getEntityName($entity);
        return sprintf('%s updated by %s -> %s', $entityName, $username, $itemData);
    }
}
