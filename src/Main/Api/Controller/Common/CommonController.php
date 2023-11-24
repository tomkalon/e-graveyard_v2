<?php

namespace App\Main\Api\Controller\Common;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommonController extends AbstractController
{
    public function toggleTheme(): JsonResponse
    {

        return $this->json(true);
    }
}
