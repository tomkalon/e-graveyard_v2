<?php

namespace App\Admin\Infrastructure\Validator\User;

use Symfony\Component\Validator\Constraint;

class UserPassword extends Constraint
{
    public string $passwords_is_too_short = 'validation.user.password.password_is_too_short';
    public string $passwords_not_match = 'validation.user.password.passwords_not_match';
    public string $password_without_capital = 'validation.user.password.password_without_capital_letter';
    public string $password_without_number = 'validation.user.password.password_without_number';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}
