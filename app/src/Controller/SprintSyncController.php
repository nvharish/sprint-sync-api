<?php

namespace App\Controller;

use App\Dto\SprintDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SprintSyncController extends AbstractController
{
    #[Route('/sprint/sync', name: 'app_sprint_sync', methods: Request::METHOD_POST)]
    public function index(SprintDto $sprintDto): array
    {
        return [
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SprintSyncController.php',
        ];
    }
}
