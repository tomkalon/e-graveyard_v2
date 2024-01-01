<?php

namespace App\Admin\UI\Form\Grave;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Domain\Entity\Graveyard;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class GraveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('graveyard', EntityType::class, [
                'class' => Graveyard::class,
                'choice_label' => 'name',
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => 'validation.not_null'
                    ])
                ]
            ])
            ->add('sector', IntegerType::class, [
                'required' => true,
            ])
            ->add('row', IntegerType::class, [
                'required' => false,
            ])
            ->add('number', IntegerType::class, [
                'required' => true,
            ])
            ->add('positionX', TextType::class, [
                'required' => false,
            ])
            ->add('positionY', TextType::class, [
                'required' => false,
            ])
            ->add('create', SubmitType::class, [
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
            'data_class' => GraveDto::class,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.grave.%name%',
        ]);
    }
}
