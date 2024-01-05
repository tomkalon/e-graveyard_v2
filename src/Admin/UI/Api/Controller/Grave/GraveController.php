<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Infrastructure\Query\Grave\GetGraveInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractFOSRestController
{
    public function get(
        string $id,
        GetGraveInterface $query
    ): Response
    {
        $data = $query->execute($id);
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): void {
        $commandBus->dispatch(new RemoveGraveCommand($id));
    }
}
