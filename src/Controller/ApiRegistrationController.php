<?php

namespace App\Controller;

use App\DTO\User\CreateUserDto;
use App\Repository\UserRepository;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ApiRegistrationController extends AbstractController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    #[Route('/api/register', name: 'app_api_registration', methods: 'POST')]
    public function register(Request $request, DTOSerializer $serializer): JsonResponse
    {
        $createUserDto = $serializer->deserialize($request->getContent(), CreateUserDto::class, 'json');
        $user = $this->userRepository->createUser($createUserDto);
        return $this->json([
            'message' => 'User successfully created',
            'user' => [
                'username' => $user->getUsername(),
                'role' => $user->getRoles()
            ],
            'statusCode' => Response::HTTP_CREATED
        ]);
    }
}
