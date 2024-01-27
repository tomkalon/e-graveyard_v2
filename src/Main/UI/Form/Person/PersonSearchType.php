<?php

namespace App\Main\UI\Form\Person;

use App\Admin\Domain\View\Person\PersonView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
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
                'label' => 'ui.buttons.add',
                'attr' => array(
                    'class' => 'btn btn-green'
                )
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonView::class,
            'allow_extra_fields' => true,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.person.%name%',
        ]);
    }
}
