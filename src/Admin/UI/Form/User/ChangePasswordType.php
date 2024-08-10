<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\UI\Form\User;

use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Validator\User\UserPassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('password', PasswordType::class, [
                'required' => true,
                'constraints' => [
                    new UserPassword(),
                ],
            ])
            ->add('repeatPassword', PasswordType::class, [
                'required' => true,
            ])
            ->add('saveChanges', SubmitType::class, [
                'label' => 'ui.buttons.save_changes',
                'attr' => [
                    'class' => 'btn btn-success',
                ],
            ])
        ;
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
