<?php

namespace App\Main\Controller\Frontpage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('main/Frontpage/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
