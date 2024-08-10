<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Validator\User;

use Symfony\Component\Validator\Constraint;

class isUniqueUser extends Constraint
{
    public string $username = 'validation.user.is_not_unique_username';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}
