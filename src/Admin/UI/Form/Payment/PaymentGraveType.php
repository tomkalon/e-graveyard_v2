<?php

namespace App\Admin\UI\Form\Payment;

use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentGraveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value', NumberType::class, [
                'required' => true,
            ])
            ->add('description', TextType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PaymentGraveDto::class,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.payment.%name%',
        ]);
    }
}
