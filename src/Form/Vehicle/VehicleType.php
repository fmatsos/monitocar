<?php

namespace App\Form\Vehicle;

use App\Entity\Vehicle\FuelType;
use App\Entity\Vehicle\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fuelCapacity', IntegerType::class)
            ->add('fuelConsumption', IntegerType::class)
            ->add('mileageFromOdometers', CollectionType::class, [
                'entry_type' => NumberType::class,
            ])
            ->add('modelDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('name')
            ->add('purchaseDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('fuelType', EntityType::class, [
                'class' => FuelType::class,
                'choice_label' => static function (FuelType $fuelType) {
                    return $fuelType->name;
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
