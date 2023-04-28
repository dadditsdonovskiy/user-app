<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/api/films', name: 'app_api_film_list', methods: 'GET')]
    public function register(): JsonResponse
    {
        return $this->json([
            'message' => 'films'
        ]);
    }
}