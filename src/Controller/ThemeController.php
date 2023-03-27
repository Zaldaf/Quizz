<?php

namespace App\Controller;

use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ThemeController extends AbstractController
{
    private ThemeRepository $themeRepository;
    private SerializerInterface $serializer;

    public function __construct(ThemeRepository $themeRepository, SerializerInterface $serializer)
    {
        $this->themeRepository = $themeRepository;
        $this->serializer = $serializer;
    }


    #[Route('/theme', name: 'app_theme',methods: "GET")]
    public function listThemes(): Response
    {
        $themes = $this->themeRepository->findAll();
        $serializedThemes = $this->serializer->serialize($themes, 'json');

        return new Response($serializedThemes, Response::HTTP_OK, [
            'Content-Type' => 'application/json'
        ]);
    }
}
