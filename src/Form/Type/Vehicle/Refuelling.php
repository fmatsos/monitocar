<?php

namespace App\Form\Vehicle;

use App\Entity\Vehicle\Refuelling as RefuellingEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Refuelling extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price')
            ->add('quantity')
            ->add('vehicle')
            ->add('fuelType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RefuellingEntity::class,
        ]);
    }
}
