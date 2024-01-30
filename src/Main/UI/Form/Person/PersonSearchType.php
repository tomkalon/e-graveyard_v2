<?php

namespace App\Main\UI\Form\Person;

use App\Main\Domain\View\DeceasedSearchView;
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
                'label' => 'ui.buttons.search',
                'attr' => array(
                    'class' => 'class="inline-block rounded border-2 border-slate-500 px-6 pb-[6px]
                     pt-2 text-md font-medium uppercase leading-normal text-slate-500
                     dark:text-neutral-50 dark:border-neutral-50
                      transition duration-150 ease-in-out
                       hover:dark:border-neutral-100 hover:dark:bg-neutral-500 hover:dark:bg-opacity-10 hover:dark:text-neutral-100
                       hover:bg-slate-500 hover:text-neutral-100
                        focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0
                        active:border-neutral-200 active:text-neutral-200 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10'
                )
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeceasedSearchView::class,
            'allow_extra_fields' => true,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.person.%name%',
        ]);
    }
}
