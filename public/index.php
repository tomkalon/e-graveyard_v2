<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
