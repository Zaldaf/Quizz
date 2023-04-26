<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ThemeController extends AbstractController
{
    private ThemeRepository $themeRepository;
    private SerializerInterface $serializer;
    private QuestionRepository $questionRepository;

    public function __construct(ThemeRepository $themeRepository, SerializerInterface $serializer, QuestionRepository $questionRepository)
    {
        $this->themeRepository = $themeRepository;
        $this->serializer = $serializer;
        $this->questionRepository = $questionRepository;
    }


    #[Route('api/theme', name: 'app_theme',methods: "GET")]
    public function listThemes(): Response
    {
        $themes = $this->themeRepository->findAll();
        $serializedThemes = $this->serializer->serialize($themes, 'json',['groups'=>'listeTheme']);

        return new Response($serializedThemes, Response::HTTP_OK, [
            'Content-Type' => 'application/json'
        ]);
    }

    #[Route('api/theme/{id}/questions/{nb}', name: 'app_theme_question', methods: ['GET'])]
    public function getThemeQuestion($id, $nb): Response
    {

        $questions =$this->questionRepository->findBy(["Theme"=>$id]);
        shuffle($questions);
        $randQuestion = array_slice($questions,0,$nb);
        $QuestionJson = $this->serializer->serialize($randQuestion, 'json' ,['groups'=>'getQuestion']);

        return new Response($QuestionJson , Response::HTTP_OK, ['content-type' => 'application/json']);
    }
}
