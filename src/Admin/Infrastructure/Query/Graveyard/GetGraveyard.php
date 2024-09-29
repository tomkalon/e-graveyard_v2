<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Admin\Domain\Repository\GraveyardRepositoryInterface;
use App\Core\Domain\Entity\Graveyard;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

readonly class GetGraveyard implements GetGraveyardInterface
{
    public function __construct(
        private GraveyardRepositoryInterface $graveyardRepository,
    ) {}

    /**
     * @throws EntityNotFoundException
     */
    public function execute(string $id): ?Graveyard
    {
        try {
            return $this->graveyardRepository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
