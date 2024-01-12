<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Infrastructure\Query\Grave\GetGraveDtoInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GraveController extends AbstractController
{
    public function get(
        string $id,
        GetGraveDtoInterface $query,
    ): JsonResponse {
        $dto = $query->execute($id);
        return new JsonResponse($dto);
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): JsonResponse {
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return new JsonResponse(true);
    }
}
