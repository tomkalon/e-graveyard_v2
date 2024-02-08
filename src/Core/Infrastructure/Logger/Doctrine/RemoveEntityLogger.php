<?php

namespace App\Core\Infrastructure\Logger\Doctrine;

class RemoveEntityLogger extends AbstractEntityLogger
{
    public function createMessage(object $entity): string
    {
        $username = $this->getLoggedUsername();
        $itemData = $this->getItemData($entity);

        $entityName = $this->getEntityName($entity);
        return sprintf('%s removed by %s -> %s', $entityName, $username, $itemData);
    }
}
