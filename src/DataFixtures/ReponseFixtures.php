<?php

namespace App\DataFixtures;

use App\Entity\Reponse;
use App\Repository\QuestionRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReponseFixtures extends Fixture implements DependentFixtureInterface
{
    private QuestionRepository $questionRepository;

    /**
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $reponses = [
            ['intitule' => 'Paris','correct' => 1,'question' => $this->questionRepository->findOneBy(['intituler' => 'Quelle est la plus grande ville de France ?'])],
            ['intitule' => 'Marseille','correct' => 0,'question' => $this->questionRepository->findOneBy(['intituler' => 'Quelle est la plus grande ville de France ?'])],
            ['intitule' => 'Besançon','correct' => 0,'question' => $this->questionRepository->findOneBy(['intituler' => 'Quelle est la plus grande ville de France ?'])],
            ['intitule' => 'Tours','correct' => 0,'question' => $this->questionRepository->findOneBy(['intituler' => 'Quelle est la plus grande ville de France ?'])]
        ];

        foreach ($reponses as $response){
            $fixture = new Reponse();
            $fixture->setIntituler($response['intitule']);
            $fixture->setIsCorrect($response['correct']);
            $fixture->addQuestion($response['question']);

            $manager->persist($fixture);
        }



        $manager->flush();
    }
    public function  getDependencies(){
        return [
            QuestionFixtures::class
        ];
    }
}
