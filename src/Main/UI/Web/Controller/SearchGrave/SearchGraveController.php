<?php

namespace App\Main\UI\Web\Controller\SearchGrave;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchGraveController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('', [

        ]);
    }
}
