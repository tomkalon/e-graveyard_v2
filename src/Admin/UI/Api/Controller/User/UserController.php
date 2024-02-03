<?php

namespace App\Admin\UI\Api\Controller\User;

use App\Admin\Application\Command\User\RemoveUserCommand;
use App\Admin\Application\Dto\User\UserDto;
use App\Admin\Infrastructure\Query\User\GetUserInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractFOSRestController
{
    public function get(
        string $id,
        GetUserInterface $query,
        SerializerInterface $serializer
    ): Response
    {
        $user = $query->execute($id);
        $userDto = UserDto::fromEntity($user);
        return new Response($serializer->serialize($userDto, 'json'));
    }


    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemoveUserCommand($id));
        return $this->json('true');
    }
}
