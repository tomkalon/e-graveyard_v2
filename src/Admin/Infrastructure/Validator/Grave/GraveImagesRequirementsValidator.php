<?php

namespace App\Admin\Infrastructure\Validator\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Domain\Entity\Grave;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GraveImagesRequirementsValidator extends ConstraintValidator
{
    public function __construct(
    ) {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var Grave $graveData */
        $graveData = $this->context->getRoot()->getData();
        $currentImagesCount = $graveData->getImages()->count();
        $newImagesCount = count($this->context->getRoot()->get('images')->getData());

        if (($currentImagesCount + $newImagesCount) > 4) {
            $this->context->buildViolation($constraint->maxNumberOfImagesExceeded)
                ->addViolation();
        }
    }
}
