<?php

namespace App\Admin\Infrastructure\Validator\Grave;
use Symfony\Component\Validator\Constraint;

class ImagesOptions extends Constraint
{
    public string $message = 'test';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
