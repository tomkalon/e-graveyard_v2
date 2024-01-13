<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Infrastructure\Query\Grave\GetGraveDtoInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class GraveController extends AbstractFOSRestController
{
    public function get(
        string $id,
        GetGraveDtoInterface $query,
        SerializerInterface $serializer
    ): Response {
        $dto = $query->execute($id);
        return new Response($serializer->serialize($dto, 'json'));
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return $this->json('true');
    }
}
