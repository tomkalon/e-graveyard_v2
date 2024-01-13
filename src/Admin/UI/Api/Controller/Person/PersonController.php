<?php

namespace App\Admin\UI\Api\Controller\Person;

use App\Admin\Application\Command\Person\RemovePersonCommand;
use App\Admin\Application\Dto\Person\PersonDto;
use App\Admin\Infrastructure\Query\Person\GetPersonInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class PersonController extends AbstractFOSRestController
{
    public function get(
        string $id,
        GetPersonInterface $query,
        SerializerInterface $serializer
    ): Response {
        $dto = PersonDto::fromEntity($query->execute($id));
        return new Response($serializer->serialize($dto, 'json'));
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemovePersonCommand($id));
        return $this->json('true');
    }
}
