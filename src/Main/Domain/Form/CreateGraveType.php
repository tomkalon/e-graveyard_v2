<?php

namespace App\Main\Domain\Form;

use App\Core\Entity\Graveyard;
use App\Main\Domain\Dto\Grave\GraveDto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateGraveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('graveyard', EntityType::class, [
                'class' => Graveyard::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('sector', IntegerType::class, [
                'required' => true,
                'attr' => array(
                    'class' => 'w-52 py-3 px-3 rounded-lg bg-gray-800 border border-gray-700 text-gray-50 font-semibold
                     focus:border-blue-500 focus:outline-none',
                    'placeholder' => 'fe.family.name'
                ),
            ])
            ->add('row', IntegerType::class, [
                'required' => false,
            ])
            ->add('number', IntegerType::class, [
                'required' => true,
            ])
            ->add('positionX', TextType::class, [
                'required' => true,
            ])
            ->add('positionY', TextType::class, [
                'required' => true,
            ])
            ->add('create', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-green'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GraveDto::class,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.main.grave.%name%',
        ]);
    }
}
