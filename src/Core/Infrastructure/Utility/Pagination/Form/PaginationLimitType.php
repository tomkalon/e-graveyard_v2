<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Utility\Pagination\Form;

use App\Core\Domain\Enum\PaginationLimitEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaginationLimitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = PaginationLimitEnum::toArrayValues();

        $builder
            ->add('limit', ChoiceType::class, [
                'choices' => $choices,
                'label_attr' => ['class' => 'hidden'],
                'required' => true,
                'attr' => [
                    'onchange' => "console.log(this.form.submit());",
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'POST',
            'csrf_protection' => true,
        ]);
    }
}
