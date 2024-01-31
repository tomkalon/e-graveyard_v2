<?php

namespace App\Main\UI\Web\Controller\Frontpage;

use App\Main\Infrastructure\Query\Frontpage\DeceasedSearchPaginatedListQueryInterface;
use App\Main\UI\Form\Person\PersonSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends AbstractController
{
    public function index(): Response
    {
        $searchForm = $this->createForm(PersonSearchType::class);

        return $this->render('main/frontpage/index.html.twig', [
            'form' => $searchForm->createView()
        ]);
    }

    public function search(
        Request $request,
        DeceasedSearchPaginatedListQueryInterface $query
    ): Response
    {
        $searchForm = $this->createForm(PersonSearchType::class);
        $searchForm->handleRequest($request);

        $peopleList = [];
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $personView = $searchForm->getData();
            $peopleList = $query->execute(
                1,
                10,
                $personView
            );
        }

        return $this->render('main/frontpage/search_js.html.twig', [
            'form' => $searchForm->createView(),
            'pagination' => $peopleList
        ]);
    }

    public function show(
        Request $request,
        string $id
    ): Response
    {
        return $this->render('main/frontpage/show.html.twig', [

        ]);
    }
}
