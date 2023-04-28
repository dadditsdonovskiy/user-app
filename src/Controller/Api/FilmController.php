<?php

namespace App\Controller\Api;

use App\DTO\Film\CreateFilmDto;
use App\Repository\FilmRepository;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    public function __construct(private readonly FilmRepository $filmRepository)
    {
    }

    #[Route('/api/films/create', name: 'film-create', methods: 'POST')]
    public function create(Request $request, DTOSerializer $serializer): JsonResponse
    {
        $createFilmDto = $serializer->deserialize($request->getContent(), CreateFilmDto::class, 'json');
        $film = $this->filmRepository->createFilm($createFilmDto);
        return $this->json([
            'message' => 'Film successfully created',
            'film' => $film,
            'statusCode' => Response::HTTP_CREATED
        ]);
    }

    #[Route('/api/films/{id}/delete', name: 'film-remove', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        if ($this->filmRepository->deleteFilmById($id)) {
            return new JsonResponse(['status' => 'Film deleted'], Response::HTTP_OK);
        }

        throw new NotFoundHttpException('film not found');
    }

    #[Route('/films', name: 'film-list', methods: 'GET')]
    public function index(): JsonResponse
    {
        $films = $this->filmRepository->findAll();
        return $this->json($films);
    }
}
