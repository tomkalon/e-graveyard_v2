<?php

namespace App\Main\Web\Controller\Frontpage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('Main/Frontpage/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
