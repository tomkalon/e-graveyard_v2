<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Grave;

use App\Admin\Application\Service\File\Grave\SaveFileGraveServiceInterface;
use App\Admin\Application\Service\Grave\SaveGraveServiceInterface;
use App\Admin\Application\Service\Upload\ImageUploaderServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class GraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ImageUploaderServiceInterface $uploaderService,
        private SaveFileGraveServiceInterface $saveFileGrave,
        private SaveGraveServiceInterface     $graveService,
    ) {}

    public function __invoke(GraveCommand $command)
    {
        $graveView = $command->getGrave();

        /** @var UploadedFile[] $uploadedImages */
        $uploadedImages = $command->getImages();

        if ($uploadedImages) {
            foreach ($uploadedImages as $uploadedImage) {
                $imageVo = $this->uploaderService->upload($uploadedImage);
                if ($imageVo) {
                    $image = $this->saveFileGrave->persist($imageVo);
                    $graveView->addImage($image);
                }
            }
        }

        $this->graveService->persist($graveView);
    }
}
