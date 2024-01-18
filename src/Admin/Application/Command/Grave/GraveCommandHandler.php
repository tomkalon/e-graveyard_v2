<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Application\Service\File\Grave\GraveUploaderServiceInterface;
use App\Admin\Application\Service\Grave\SaveGraveServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

class GraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly GraveUploaderServiceInterface $uploaderService,
        private readonly SaveGraveServiceInterface     $graveService,
    ) {
    }

    public function __invoke(GraveCommand $command)
    {
        $grave = $command->getGrave();
        $uploadedImages = $command->getImages();
        if ($uploadedImages and reset($uploadedImages)) {
            foreach ($uploadedImages as $uploadedImage) {
                $image = $this->uploaderService->upload($uploadedImage);
                if ($image) {
                    $grave->addImages($image);
                }
            }
        }

        $this->graveService->persist($grave);
    }
}
