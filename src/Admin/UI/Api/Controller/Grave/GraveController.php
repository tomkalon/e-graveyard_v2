<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Infrastructure\Query\Grave\GetGraveInterface;
use App\Admin\Infrastructure\Service\ApiView\Grave\GraveView;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GraveController extends AbstractController
{
    public function get(
        string $id,
        GetGraveInterface $query,
        GraveView $graveView
    ): JsonResponse
    {
        $data = $query->execute($id);
        return new JsonResponse($graveView->getView($data));
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): JsonResponse {
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return new JsonResponse(true);
    }
}
