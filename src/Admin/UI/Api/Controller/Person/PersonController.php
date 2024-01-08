<?php

namespace App\Admin\UI\Api\Controller\Person;

use App\Admin\Application\Command\Person\RemovePersonCommand;
use App\Admin\Infrastructure\Query\Person\GetPersonInterface;
use App\Admin\Infrastructure\View\Person\PersonView;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends AbstractController
{
    public function get(
        string $id,
        GetPersonInterface $query,
        PersonView $personView
    ): JsonResponse {
        $data = $query->execute($id);
        return new JsonResponse($personView->getView($data));
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemovePersonCommand($id));
        return new JsonResponse(true);
    }
}
