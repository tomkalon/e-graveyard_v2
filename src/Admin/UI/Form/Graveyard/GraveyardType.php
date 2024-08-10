<?php

namespace App\Admin\UI\Form\Graveyard;

use App\Admin\Domain\View\Graveyard\GraveyardView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraveyardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'ui.graveyard.desc',
                'required' => false,
                'attr' => ['class' => 'text-black rounded-md w-full min-h-[120px]'],
            ])
            ->add('create', SubmitType::class, [
                'label' => 'ui.buttons.create',
                'attr' => array(
                    'class' => 'btn btn-green',
                ),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GraveyardView::class,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.graveyard.%name%',
        ]);
    }
}
