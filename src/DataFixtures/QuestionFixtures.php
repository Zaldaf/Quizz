<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $questions = [
            ['intituler' => 'quelle est la capitale de la Roumanie ?','theme' => $this->getReference("theme".(0))],
            ['intituler' => 'Quelle est la plus grande ville de France ?','theme' => $this->getReference("theme".(0))],
            ['intituler' => "Quelle pays ne fais pas partie de l'union européenne ?",'theme' => $this->getReference("theme".(0))]

        ];

        foreach ($questions as $question){
            $fixture = new Question();
            $fixture->setIntituler($question['intituler']);
            $fixture->setTheme($question['theme']);
            $manager->persist($fixture);
        }



        $manager->flush();
    }
    public function  getDependencies(){
        return [
            ThemeFixtures::class
        ];
    }
}