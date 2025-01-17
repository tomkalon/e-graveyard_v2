<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\UI\Form\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Enum\UserRoleEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class, [
                'required' => true,
            ])
            ->add('roles', EnumType::class, [
                'label' => 'ui.user.role.label',
                'class' => UserRoleEnum::class,
                'data' => UserRoleEnum::MANAGER,
                'choice_label' => fn(UserRoleEnum $enum) => $this->translateEnum($enum),
                'choices' => [
                    'User' => UserRoleEnum::USER,
                    'Manager' => UserRoleEnum::MANAGER,
                    'Admin' => UserRoleEnum::ADMIN,
                ],
                'required' => true,
            ])
            ->add('change', SubmitType::class, [
                'label' => 'ui.buttons.change',
                'attr' => [
                    'class' => 'btn btn-success',
                ],
            ]);
    }

    private function translateEnum(UserRoleEnum $enum): string
    {
        return 'ui.enums.userRole.' . $enum->value;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserView::class,
            'method' => 'POST',
            'csrf_protection' => true,
        ]);
    }
}
