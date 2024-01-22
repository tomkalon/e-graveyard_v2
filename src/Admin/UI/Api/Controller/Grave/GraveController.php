<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Application\Command\Grave\SetMainImageCommand;
use App\Admin\Infrastructure\Query\Grave\GetGraveDtoInterface;
use App\Admin\Infrastructure\Query\Grave\GetGraveImagesDto;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Entity\Grave;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
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
        Grave $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return $this->json('true');
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getImages(
        string $id,
        GetGraveImagesDto $query,
        SerializerInterface $serializer
    ): Response {
        $dto = $query->execute($id);
        return new Response($serializer->serialize($dto, 'json'));
    }

    public function setMainImage(
        string $id,
        Request $request,
        CommandBusInterface $commandBus
    ): Response {
        $imageId = base64_decode($request->request->all('params')['image']);
        $commandBus->dispatch(new SetMainImageCommand($id, $imageId));
        return $this->json('true');
    }
}
