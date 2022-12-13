<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=0; $i < 4; $i++) { 
            $person = new Persons();
            $person->setName ('Degraeve');
            $person->setFirstname('Enzo');
            $person->setPhone('0767635400');
            $person->setAdress('Rue de la gare 1');
            $person->setCity('Bruxelles');
            $person->setAge(random_int(5, 34));

            // tell Doctrine you want to (eventually) save the person (no queries yet)
            $manager->persist($person);
        }

        $manager->flush();
    }
}
