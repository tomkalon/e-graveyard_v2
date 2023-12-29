<?php

namespace App\Admin\UI\Api\Controller\Grave;

use App\Admin\Infrastructure\Query\Grave\GetGraveInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GraveController extends AbstractController
{
    public function getGrave(
        string $id,
        GetGraveInterface $query
    ): JsonResponse {
        $data = $query->execute($id);
        return $this->json($data->toArray());
    }
}
