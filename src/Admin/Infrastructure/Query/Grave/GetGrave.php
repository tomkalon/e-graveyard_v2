<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Domain\Entity\Grave;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetGrave implements GetGraveInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function execute(?string $id): Grave
    {
        try {
            $grave = $this->repository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
        return $grave;
    }
}
