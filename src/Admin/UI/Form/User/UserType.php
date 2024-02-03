<?php

namespace App\Admin\UI\Form\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Domain\Enum\UserRoleEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'required' => true,
            ])
            ->add('roles', EnumType::class, [
                'label' => 'ui.user.role',
                'class' => UserRoleEnum::class,
                'data' => UserRoleEnum::USER,
                'choice_label' => fn(UserRoleEnum $enum) => $this->translateEnum($enum),
                'choices' => [
                    'User' => UserRoleEnum::USER,
                    'Admin' => UserRoleEnum::MANAGER,
                ],
                'required' => true
            ])
            ->add('create', SubmitType::class, [
                'label' => 'ui.buttons.create',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    private function translateEnum(UserRoleEnum $enum): string
    {
        return 'ui.enums.userRoleType.' . $enum->value;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserView::class,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.user.login.%name%',
        ]);
    }
}
