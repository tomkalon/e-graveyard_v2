<?php

namespace App\Admin\UI\Api\Controller\Payment;

use App\Admin\Application\Command\Payment\RemovePaymentCommand;
use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use App\Admin\Infrastructure\Query\Payment\Grave\GetPaymentGraveInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Enum\UserRoleEnum;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class PaymentGraveController extends AbstractFOSRestController
{
    public function get(
        string $id,
        GetPaymentGraveInterface $query,
        SerializerInterface $serializer,
    ): Response {
        $dto = PaymentGraveDto::fromEntity($query->execute($id));
        return new Response($serializer->serialize($dto, 'json'));
    }

    public function remove(
        string $id,
        CommandBusInterface $commandBus,
    ): Response {
        if (!$this->isGranted(UserRoleEnum::ADMIN->value)) {
            throw new AccessDeniedException('Access denied.');
        }
        $commandBus->dispatch(new RemovePaymentCommand($id));
        return $this->json('true');
    }
}
