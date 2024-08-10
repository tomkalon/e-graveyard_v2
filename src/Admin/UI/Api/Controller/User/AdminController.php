<?php

namespace App\Admin\UI\Api\Controller\User;

use App\Admin\Application\Command\User\RemoveUserCommand;
use App\Admin\Application\Command\User\ResetPasswordCommand;
use App\Admin\Application\Dto\User\UserDto;
use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Query\User\GetUserInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;

class AdminController extends AbstractFOSRestController
{
    public function get(
        string $id,
        GetUserInterface $query,
        SerializerInterface $serializer
    ): Response {
        $user = $query->execute($id);
        $userDto = UserDto::fromEntity($user);
        return new Response($serializer->serialize($userDto, 'json'));
    }

    /**
     * @throws Exception
     */
    public function resetPassword(
        string $id,
        GetUserInterface $query,
        CommandBusInterface $commandBus
    ): Response {
        $userId = base64_decode($id);

        if ($userId) {
            $user = $query->execute($userId);
            $userView = UserView::fromEntity($user);
            $userView->setId($userId);
            $commandBus->dispatch(new ResetPasswordCommand($userView));
            return $this->json('true');
        } else {
            throw new NotFoundHttpException('Invalid User ID.');
        }
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemoveUserCommand($id));
        return $this->json('true');
    }
}
