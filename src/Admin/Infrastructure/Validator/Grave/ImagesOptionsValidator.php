<?php

namespace App\Admin\Infrastructure\Validator\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Domain\Entity\Grave;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ImagesOptionsValidator extends ConstraintValidator
{
    public function __construct(
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly RequestStack $requestStack
    )
    {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        $request = $this->requestStack->getCurrentRequest();
        $id = $request->attributes->get('id');
        $grave = $this->graveRepository->find($id);

        if ($grave) {
            /** @var Grave $grave */
            $graveData = $this->context->getRoot()->getData();
        }
    }
}
