<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Domain\Entity\Grave;
use Doctrine\Common\Collections\Criteria;

class GetGrave implements GetGraveInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
    ) {
    }
    public function execute(?string $id): Grave
    {
        return $this->repository->find($id);
    }
}
