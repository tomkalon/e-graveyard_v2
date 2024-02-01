<?php

namespace App\Admin\Infrastructure\Query\Settings;

use App\Core\Domain\Entity\Settings;
use App\Core\Domain\Repository\SettingsRepositoryInterface;

class GetSettings implements GetSettingsInterface
{
    public function __construct(
        private readonly SettingsRepositoryInterface $settingsRepository
    )
    {
    }

    public function execute(): Settings
    {
        return $this->settingsRepository->getSettings();
    }
}
