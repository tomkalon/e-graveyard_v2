<?php

namespace App\Admin\UI\Form\User;

use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Validator\User\isUniqueEmail;
use App\Admin\Infrastructure\Validator\User\isUniqueUser;
use App\Core\Domain\Enum\UserRoleEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInvitationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new isUniqueEmail()
                ]
            ])
            ->add('create', SubmitType::class, [
                'label' => 'ui.buttons.create',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
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
