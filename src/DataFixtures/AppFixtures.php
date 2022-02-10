<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 20; $i++) {

            $vehicle = new Vehicle();
            // $vehicle->setId($request->request->get('id'));
            $vehicle->setDate(\DateTime::createFromFormat('Y-m-d', date('Y-m-d')));
            $vehicle->setType(array_rand(["new", "used"]));
            $vehicle->setMsrp(mt_rand(0, 10));
            $vehicle->setYear(mt_rand(1980, 2023));
            $vehicle->setMake(array_rand(["Acura", "Chevrolet", "Honda", "Toyota", "Tesla"]));
            $vehicle->setModel(array_rand(["Acadia", "Accord", "Air", "Altima"]));
            $vehicle->setMiles(mt_rand(0, 100000));
            $vehicle->setVin(mt_rand(100000,999999));
            $vehicle->setDeleted(array_rand([True, False]));

            $manager->persist($vehicle);
        }

        $manager->flush();
    }
}
