<?php

namespace App\Form\Type\Vehicle;

use App\Entity\Vehicle\FuelType;
use App\Entity\Vehicle\Vehicle as VehicleEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Vehicle extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fuelCapacity', IntegerType::class, [
                'required' => false,
            ])
            ->add('fuelConsumption', IntegerType::class, [
                'required' => false,
            ])
            ->add('mileageFromOdometers', NumberType::class, [
                'required' => false,
                'scale' => 2,
            ])
            ->add('modelDate', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('name', TextType::class)
            ->add('purchaseDate', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('fuelType', EntityType::class, [
                'required' => true,
                'class' => FuelType::class,
                'choice_label' => fn(FuelType $fuelType): string => $fuelType->name,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VehicleEntity::class,
        ]);
    }
}
