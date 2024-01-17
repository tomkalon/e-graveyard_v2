<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Application\Services\File\UploaderServiceInterface;
use App\Admin\Application\Services\Grave\SaveGraveServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

class GraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UploaderServiceInterface  $uploaderService,
        private readonly SaveGraveServiceInterface $graveService,
    ) {
    }

    public function __invoke(GraveCommand $command)
    {
        $grave = $command->getGrave();
        $images = $command->getImages();

        if (reset($images)) {
            $image = $this->uploaderService->upload(reset($images));
            if ($image) {
                $grave->setMainImage($image);
            }
        }


        $this->graveService->persist($grave);
    }
}
