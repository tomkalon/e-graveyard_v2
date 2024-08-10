<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Validator\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Admin\Domain\View\User\UserView;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class isUniqueEmailValidator extends ConstraintValidator
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var UserView $userView */
        $userView = $this->context->getRoot()->getData();

        if ($this->userRepository->getUsersByOptions($userView->getEmail())) {
            $this->context->buildViolation($constraint->email)
                ->addViolation();
        }
    }
}
