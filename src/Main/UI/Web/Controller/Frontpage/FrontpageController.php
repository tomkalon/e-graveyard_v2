<?php

namespace App\Main\UI\Web\Controller\Frontpage;

use App\Admin\Domain\View\Person\PersonView;
use App\Main\UI\Form\Person\PersonSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends AbstractController
{
    public function index(
        Request $request
    ): Response
    {
        $searchForm = $this->createForm(PersonSearchType::class);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
                $personView = $searchForm->getData();
            }

        return $this->render('main/frontpage/index.html.twig', [
            'form' => $searchForm->createView()
        ]);
    }
}
