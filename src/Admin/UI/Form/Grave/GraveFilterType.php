<?php

namespace App\Admin\UI\Form\Grave;

use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Core\Domain\Entity\Graveyard;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraveFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('graveyard', EntityType::class, [
                'class' => Graveyard::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('sector', IntegerType::class, [
                'required' => false,
            ])
            ->add('row', IntegerType::class, [
                'required' => false,
            ])
            ->add('number', IntegerType::class, [
                'required' => false,
            ])
            ->add('search', SubmitType::class, [
                'label' => 'ui.buttons.search',
                'attr' => array(
                    'class' => 'btn btn-green',
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GraveFilterView::class,
            'allow_extra_fields' => false,
            'method' => 'GET',
            'csrf_protection' => true,
            'label_format' => 'ui.grave.%name%',
        ]);
    }
}
