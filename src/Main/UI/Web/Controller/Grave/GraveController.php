<?php

namespace App\Main\UI\Web\Controller\Grave;

use App\Main\Domain\Form\Grave\CreateGraveType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('Main/Grave/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    public function create(Request $request): Response
    {
        $form = $this->createForm(CreateGraveType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

        }

        return $this->render('Main/Grave/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
