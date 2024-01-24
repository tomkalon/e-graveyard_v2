<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveView;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetGraveView implements GetGraveViewInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(string $id): GraveView
    {
        try {
            $grave = $this->graveRepository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }

        if ($grave) {
            return GraveView::fromEntity($grave);
        } else {
            throw new EntityNotFoundException('No entity with the given ID was found.');
        }
    }
}
