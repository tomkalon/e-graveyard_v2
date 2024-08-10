<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\Settings;

use App\Core\Domain\Entity\Settings;

interface GetSettingsInterface
{
    public function execute(
    ): Settings;
}
