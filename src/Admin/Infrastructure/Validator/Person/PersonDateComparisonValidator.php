<?php

namespace App\Admin\Infrastructure\Validator\Person;

use App\Core\Domain\Entity\Person;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PersonDateComparisonValidator extends ConstraintValidator
{

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var Person $person */
        $person = $this->context->getRoot()->getData();

        if ($person->getBornDate() > $person->getDeathDate()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
