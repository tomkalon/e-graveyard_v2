<?php

namespace App\Admin\UI\Form\Person;

use App\Admin\Application\Dto\Person\PersonDto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                'required' => true,
            ])
            ->add('lastDate', DateType::class, [
                'required' => true,
            ])
            ->add('grave', EntityType::class, [
                'required' => true,
            ])
            ->add('add', SubmitType::class, [
                'label' => 'ui.buttons.create',
                'attr' => array(
                    'class' => 'btn btn-green'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonDto::class,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.person.%name%',
        ]);
    }
}