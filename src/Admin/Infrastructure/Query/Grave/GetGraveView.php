<?php

namespace App\Admin\Infrastructure\Query\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveView;
use App\Core\Domain\Repository\SettingsRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetGraveView implements GetGraveViewInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly SettingsRepositoryInterface $settingsRepository
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(string $id): GraveView
    {
        try {
            $grave = $this->graveRepository->getGrave($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }

        $settings = $this->settingsRepository->getSettings();
        return GraveView::fromEntity($grave, $settings->getGravePaymentExpirationTime());
    }
}
