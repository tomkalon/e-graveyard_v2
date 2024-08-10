<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Validator\Grave;

use Symfony\Component\Validator\Constraint;

class IsGraveUnique extends Constraint
{
    public string $message = 'validation.grave.no_unique';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}
