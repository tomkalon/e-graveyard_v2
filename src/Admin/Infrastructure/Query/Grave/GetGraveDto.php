<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Domain\Repository\GraveRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetGraveDto implements GetGraveDtoInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function execute(?string $id): GraveDto
    {
        try {
            $grave = $this->repository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }

        return GraveDto::fromEntity($grave);
    }
}
