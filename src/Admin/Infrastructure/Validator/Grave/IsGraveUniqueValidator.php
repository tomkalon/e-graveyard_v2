<?php

namespace App\Admin\Infrastructure\Validator\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Domain\Repository\GraveRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsGraveUniqueValidator extends ConstraintValidator
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository
    )
    {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var GraveDto $dto */
        $dto = $this->context->getRoot()->getData();

        $grave = $this->graveRepository->findBy([
            'sector' => $dto->sector,
            'row' => $dto->row,
            'number' => $dto->number
        ]);

        if ($grave) {
            $this->context->buildViolation($constraint->message)
            ->addViolation()
            ;
        }

    }
}
