<?php

namespace App\Main\Web\Controller\Grave;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('Main/Grave/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
