<?php

namespace App\Admin\Infrastructure\Validator\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class UserPasswordValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var UserView $userView */
        $userView = $this->context->getRoot()->getData();

        if (strlen($userView->getPassword()) < 8) {
            $this->context->buildViolation($constraint->passwords_is_too_short)
                ->addViolation();
        }

        if ($userView->getPassword() !== $userView->getRepeatPassword()) {
            $this->context->buildViolation($constraint->passwords_not_match)
                ->addViolation();
        }

        if (!preg_match('/[A-Z]/', $userView->getPassword())) {
            $this->context->buildViolation($constraint->password_without_capital)
                ->addViolation();
        }

        if (!preg_match('/[0-9]/', $userView->getPassword())) {
            $this->context->buildViolation($constraint->password_without_number)
                ->addViolation();
        }
    }
}
