<?php

namespace App\Admin\Infrastructure\Validator\Grave;

use Symfony\Component\Validator\Constraint;

class GraveImagesRequirements extends Constraint
{
    public string $maxNumberOfImagesExceeded = 'validation.grave.max_number_of_images_exceeded';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}
