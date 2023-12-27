<?php

namespace App\Admin\Infrastructure\Validators\Grave;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GraveValidatorHandler extends ConstraintValidator
{

    public function validate(mixed $value, Constraint $constraint)
    {
        $dto = $this->context->getRoot()->getData();
    }
}
