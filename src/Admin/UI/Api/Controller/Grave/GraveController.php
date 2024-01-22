<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Application\Command\Grave\SetMainImageCommand;
use App\Admin\Application\Dto\File\GraveImageDto;
use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Entity\Grave;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class GraveController extends AbstractFOSRestController
{
    public function get(
        Grave $id,
        SerializerInterface $serializer
    ): Response {
        $dto = GraveDto::fromEntity($id);
        return new Response($serializer->serialize($dto, 'json'));
    }

    public function remove(
        Grave $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return $this->json('true');
    }

    public function getImages(
        Grave $id,
        SerializerInterface $serializer
    ): Response {

        $images = $id->getImages();
        $dtoArray = [];
        foreach ($images as $image) {
            $dtoArray[] = GraveImageDto::fromEntity($image);
        }

        return new Response($serializer->serialize($dtoArray, 'json'));
    }

    public function setMainImage(
        Grave $id,
        Request $request,
        CommandBusInterface $commandBus
    ): Response {
        $imageId = base64_decode($request->request->all('params')['image']);
        $commandBus->dispatch(new SetMainImageCommand($id, $imageId));
        return $this->json('true');
    }
}
