<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Logger\Doctrine;

class PersistEntityLogger extends AbstractEntityLogger
{
    public function createMessage(object $entity): string
    {
        $username = $this->getLoggedUsername();
        $itemData = $this->getItemData($entity);
        $entityName = $this->getEntityName($entity);
        return sprintf('%s created by %s -> %s', $entityName, $username, $itemData);
    }
}
