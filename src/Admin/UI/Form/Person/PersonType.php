<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\UI\Form\Person;

use App\Admin\Domain\View\Person\PersonView;
use App\Admin\Infrastructure\Validator\Person\PersonDateComparison;
use App\Core\Domain\Entity\Grave;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
            ])
            ->add('bornDate', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'constraints' => [
                    new PersonDateComparison(),
                ],
            ])
            ->add('bornDateOnlyYear', CheckboxType::class, [
                'required' => false,
            ])
            ->add('deathDate', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('deathDateOnlyYear', CheckboxType::class, [
                'required' => false,
            ])
            ->add('grave', EntityType::class, [
                'class' => Grave::class,
                'choice_label' => 'id',
                'required' => true,
            ])
            ->add('add', SubmitType::class, [
                'label' => 'ui.buttons.add',
                'attr' => array(
                    'class' => 'btn btn-green',
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonView::class,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.person.%name%',
        ]);
    }
}
