<?php

namespace App\Admin\UI\Form\Payment;

use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use App\Core\Domain\Enum\CurrencyTypeEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentGraveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value', MoneyType::class, [
                'currency' => false,
                'divisor' => 100,
                'required' => true,
            ])
            ->add('validity_time', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('currency', EnumType::class, [
                'data' => CurrencyTypeEnum::PLN,
                'class' => CurrencyTypeEnum::class,

                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'ui.payment.desc',
                'required' => false,
                'attr' => ['class' => 'text-black rounded-md w-full min-h-[120px]']
            ])
            ->add('confirm', SubmitType::class, [
                'label' => 'ui.buttons.confirm',
                'attr' => array(
                    'class' => 'btn btn-green'
                )
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
