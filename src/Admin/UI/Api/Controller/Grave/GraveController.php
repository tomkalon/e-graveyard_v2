<?php

namespace App\Admin\UI\Api\Controller\Grave;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    #[Route('/api', name: 'api_')]
    public function index(
    ): JsonResponse {
        $data = [];
        return $this->json($data);
    }
}
