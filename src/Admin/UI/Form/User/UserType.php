<?php

namespace App\Admin\UI\Form\User;

use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Validator\User\isUniqueEmail;
use App\Admin\Infrastructure\Validator\User\isUniqueUser;
use App\Admin\Infrastructure\Validator\User\UserPassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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
                'constraints' => [
                    new isUniqueUser()
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new isUniqueEmail()
                ]
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'constraints' => [
                    new UserPassword()
                ]
            ])
            ->add('repeatPassword', PasswordType::class, [
                'required' => true,
            ])
            ->add('register', SubmitType::class, [
                'label' => 'ui.user.register',
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
