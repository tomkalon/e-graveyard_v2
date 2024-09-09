<?php

namespace App\Admin\Infrastructure\Query\Graveyard;

use App\Admin\Domain\Repository\GraveyardRepositoryInterface;
use App\Admin\Domain\View\Graveyard\GraveyardView;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

readonly class GetGraveyardView implements GetGraveyardViewInterface
{
    public function __construct(
        private GraveyardRepositoryInterface $graveyardRepository,
    ) {}

    /**
     * @throws EntityNotFoundException
     */
    public function execute(string $id): ?GraveyardView
    {
        try {
            $graveyard = $this->graveyardRepository->find($id);
            return $graveyard ? GraveyardView::fromEntity($graveyard) : null;
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
