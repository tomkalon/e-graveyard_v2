<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Domain\Entity\Grave;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

readonly class GetGrave implements GetGraveInterface
{
    public function __construct(
        private GraveRepositoryInterface $graveRepository,
    ) {}

    /**
     * @throws EntityNotFoundException
     */
    public function execute(string $id): ?Grave
    {
        try {
            return $this->graveRepository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
