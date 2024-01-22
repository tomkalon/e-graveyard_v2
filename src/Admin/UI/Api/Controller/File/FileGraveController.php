<?php

namespace App\Admin\UI\Api\Controller\File;

use App\Admin\Application\Command\File\Grave\RemoveFileGraveCommand;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

class FileGraveController extends AbstractFOSRestController
{
    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemoveFileGraveCommand($id));
        return $this->json('true');
    }
}
