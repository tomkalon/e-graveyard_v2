<?php

namespace App\Main\Infrastructure\Query\Frontpage;

use App\Core\Domain\Repository\SettingsRepositoryInterface;
use App\Main\Domain\Repository\GraveRepositoryInterface;
use App\Main\Domain\View\Grave\GraveView;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetGraveView implements GetGraveViewInterface
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly SettingsRepositoryInterface $settingsRepository,
    ) {}

    /**
     * @throws EntityNotFoundException
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
