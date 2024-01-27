<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Entity\Settings;

/**
 * @method Settings|null find($id, $lockMode = null, $lockVersion = null)
 */
interface SettingsRepositoryInterface
{
    public function getSettings(): Settings;
}
