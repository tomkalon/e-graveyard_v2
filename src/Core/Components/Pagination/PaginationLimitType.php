<?php

namespace App\Core\Components\Pagination;

use App\Core\Enum\PaginationLimitEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaginationLimitType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = array_flip(PaginationLimitEnum::toArray());

        $builder
            ->add('limit', ChoiceType::class, [
                'choices'  => $choices,
                'label_attr' => ['class' => 'hidden'],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => true,
        ]);
    }
}
