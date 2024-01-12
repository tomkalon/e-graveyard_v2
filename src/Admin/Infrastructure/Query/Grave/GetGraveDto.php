<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Domain\Repository\GraveRepositoryInterface;

class GetGraveDto implements GetGraveDtoInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $repository,
    ) {
    }
    public function execute(?string $id): GraveDto
    {
        return GraveDto::fromEntity($this->repository->find($id));
    }
}
