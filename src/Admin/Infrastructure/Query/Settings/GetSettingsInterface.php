<?php

namespace App\Admin\Infrastructure\Query\Settings;

use App\Core\Domain\Entity\Settings;

interface GetSettingsInterface
{
    public function execute(
    ): Settings;
}
