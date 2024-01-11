<?php

namespace App\Admin\Infrastructure\Validator\Person;

use App\Admin\Application\Dto\Person\PersonDto;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PersonDateComparisonValidator extends ConstraintValidator
{

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var PersonDto $dto */
        $dto = $this->context->getRoot()->getData();

        if ($dto->bornDate > $dto->deathDate) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
