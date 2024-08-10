<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Validator\User;

use Symfony\Component\Validator\Constraint;

class isUniqueEmail extends Constraint
{
    public string $email = 'validation.user.is_not_unique_user';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}
