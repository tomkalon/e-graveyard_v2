<?php

namespace App\Admin\Infrastructure\Validator\Grave;

use App\Admin\Domain\View\Grave\GraveView;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GraveImagesRequirementsValidator extends ConstraintValidator
{
    public function __construct() {}

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var GraveView $graveData */
        $graveData = $this->context->getRoot()->getData();

        $currentImagesCount = $graveData->getImages() ? count($graveData->getImages()) : 0;
        $newImagesCount = count($this->context->getRoot()->get('images')->getData());

        if (($currentImagesCount + $newImagesCount) > 4) {
            $this->context->buildViolation($constraint->maxNumberOfImagesExceeded)
                ->addViolation();
        }
    }
}
