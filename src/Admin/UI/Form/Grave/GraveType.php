<?php

namespace App\Admin\UI\Form\Grave;

use App\Admin\Domain\View\Grave\GraveView;
use App\Admin\Infrastructure\Validator\Grave\GraveImagesRequirements;
use App\Admin\Infrastructure\Validator\Grave\IsGraveUnique;
use App\Core\Domain\Entity\Graveyard;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
                        'message' => 'validation.not_null',
                    ]),
                ],
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
            ->add('images', FileType::class, [
                'mapped' => false,
                'required' => false,
                'multiple' => true,
                'label' => 'ui.grave.add_images',
                'label_attr' => ['class' => 'mb-2 inline-block text-neutral-700 dark:text-neutral-200 uppercase'],
                'attr' => [
                    'class' => 'relative m-0 block w-full min-w-0 flex-auto rounded
                     border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem]
                      text-base font-normal text-neutral-700 transition duration-300 ease-in-out
                       file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none
                        file:border-0 file:border-solid file:border-inherit file:bg-neutral-100
                         file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150
                          file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem]
                           hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700
                            focus:shadow-te-primary focus:outline-none dark:border-neutral-600
                             dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100
                              dark:focus:border-primary',
                ],

                'constraints' => [
                    new GraveImagesRequirements(),
                ],
            ])
            ->add('create', SubmitType::class, [
                'label' => 'ui.buttons.create',
                'attr' => array(
                    'class' => 'btn btn-green',
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GraveView::class,
            'allow_extra_fields' => true,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.grave.%name%',
            'constraints' => [
                new IsGraveUnique(),
            ],
        ]);
    }
}
