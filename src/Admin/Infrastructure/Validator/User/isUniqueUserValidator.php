<?php

namespace App\Admin\Infrastructure\Validator\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Admin\Domain\View\User\UserView;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class isUniqueUserValidator extends ConstraintValidator
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var UserView $userView */
        $userView = $this->context->getRoot()->getData();

        if ($this->userRepository->getUsersByOptions(null, $userView->getUsername())) {
            $this->context->buildViolation($constraint->username)
                ->addViolation();
        }
    }
}
