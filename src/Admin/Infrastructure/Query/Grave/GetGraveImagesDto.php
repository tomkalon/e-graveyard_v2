<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Application\Dto\File\GraveImageDto;
use App\Admin\Domain\Repository\GraveRepositoryInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityNotFoundException;

class GetGraveImagesDto implements GetImagesDtoInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function execute(?string $id): array
    {
        try {
            $grave = $this->repository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }

        $images = $grave->getImages();

        $dtoArray = [];
        foreach ($images as $image) {
            $dtoArray[] = GraveImageDto::fromEntity($image);
        }

        return $dtoArray;
    }
}
