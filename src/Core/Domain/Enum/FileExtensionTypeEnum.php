<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Enum;

enum FileExtensionTypeEnum: string
{
    case JPG = 'jpg';
    case PNG = 'png';
    case WEBP = 'webp';
}
