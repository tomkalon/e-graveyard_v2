<?php

namespace App\Admin\Infrastructure\Validator\User;

use Symfony\Component\Validator\Constraint;

class isUniqueUser extends Constraint
{
    public string $message = 'validation.user.is_not_unique_user';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
