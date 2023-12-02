<?php

namespace App\Main\UI\Api\Controller\Common;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommonController extends AbstractController
{
    public function index(): JsonResponse
    {

        return $this->json(true);
    }
}
