<?php

namespace App\DataFixtures;

use App\Entity\Vehicle\FuelType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fuelType = new FuelType();
        $fuelType->name = 'SP95';

        $manager->persist($fuelType);
        $manager->flush();
    }
}
