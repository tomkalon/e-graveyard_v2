<?php

namespace App\Admin\UI\Form\Person;

use App\Admin\Domain\View\Person\PersonView;
use App\Admin\Infrastructure\Validator\Person\PersonDateComparison;
use App\Core\Domain\Entity\Grave;
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
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new PersonDateComparison()
                ]
            ])
            ->add('deathDate', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('grave', EntityType::class, [
                'class' => Grave::class,
                'choice_label' => 'id',
                'required' => true,
            ])
            ->add('add', SubmitType::class, [
                'label' => 'ui.buttons.add',
                'attr' => array(
                    'class' => 'btn btn-green'
                )
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
