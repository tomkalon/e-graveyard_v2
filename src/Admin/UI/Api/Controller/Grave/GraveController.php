<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Application\Command\Grave\SetMainImageCommand;
use App\Admin\Application\Dto\File\GraveImageDto;
use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Infrastructure\Query\Grave\GetGraveInterface;
use App\Admin\Infrastructure\Query\Grave\GetGraveViewInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class GraveController extends AbstractFOSRestController
{
    /**
     * @throws Exception
     */
    public function get(
        string                  $id,
        GetGraveInterface       $getGrave,
        SerializerInterface     $serializer
    ): Response {
        $grave = $getGrave->execute($id);
        $dto = GraveDto::fromEntity($grave);
        return new Response($serializer->serialize($dto, 'json'));
    }

    public function remove(
        string              $id,
        CommandBusInterface $commandBus
    ): Response {
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return $this->json('true');
    }

    public function getImages(
        string              $id,
        GetGraveInterface   $getGrave,
        SerializerInterface $serializer
    ): Response {
        $grave = $getGrave->execute($id);
        $images = $grave->getImages();
        $dtoArray = [];
        foreach ($images as $image) {
            $dtoArray[] = GraveImageDto::fromEntity($image);
        }

        return new Response($serializer->serialize($dtoArray, 'json'));
    }

    public function setMainImage(
        string                  $id,
        Request                 $request,
        GetGraveViewInterface   $getGraveView,
        CommandBusInterface     $commandBus
    ): Response {
        $graveView = $getGraveView->execute($id);
        $imageId = base64_decode($request->request->all('params')['image']);
        $commandBus->dispatch(new SetMainImageCommand($graveView, $imageId));
        return $this->json('true');
    }
}
