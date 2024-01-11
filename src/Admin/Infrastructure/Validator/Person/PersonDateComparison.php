<?php

namespace App\Admin\Infrastructure\Validator\Person;

use Symfony\Component\Validator\Constraint;

class PersonDateComparison extends Constraint
{
    public string $message = 'validation.person.born_date_is_greater_than_death_date';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
