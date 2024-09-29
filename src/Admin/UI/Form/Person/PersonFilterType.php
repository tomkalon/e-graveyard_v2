<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\UI\Form\Person;

use App\Admin\Domain\View\Person\PersonFilterView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class PersonFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'validation.length.min_message',
                    ]),
                ],
            ])
            ->add('bornYear', IntegerType::class, [
                'label' => 'ui.person.bornYear',
                'required' => false,
            ])
            ->add('deathYear', IntegerType::class, [
                'label' => 'ui.person.deathYear',
                'required' => false,
            ])
            ->add('search', SubmitType::class, [
                'label' => 'ui.buttons.search',
                'attr' => array(
                    'class' => 'btn btn-green',
                ),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonFilterView::class,
            'allow_extra_fields' => false,
            'method' => 'GET',
            'csrf_protection' => true,
            'label_format' => 'ui.person.%name%',
        ]);
    }
}
