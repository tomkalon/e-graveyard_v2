<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Validator\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Admin\Domain\View\Grave\GraveView;
use App\Core\Domain\Entity\Grave;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsGraveUniqueValidator extends ConstraintValidator
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly RequestStack $requestStack,
    ) {}

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var GraveView $graveData */
        $graveData = $this->context->getRoot()->getData();

        $request = $this->requestStack->getCurrentRequest();
        $id = $request->attributes->get('id');

        /** @var Grave[] $grave */
        $grave = $this->graveRepository->findBy([
            'sector' => $graveData->getSector(),
            'row' => $graveData->getRow(),
            'number' => $graveData->getNumber(),
        ], null, 1);

        if ($grave) {
            if ($id and ($id !== reset($grave)->getId())) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
            if (!$id) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}
