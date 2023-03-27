<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i <= 6; $i++) {
            $theme = new Theme();
            $theme->setLibel($faker->realTextBetween("6","15"));
            $manager->persist($theme);
        }

        $manager->flush();
    }
}
