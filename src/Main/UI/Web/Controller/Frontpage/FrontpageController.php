<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\UI\Web\Controller\Frontpage;

use App\Main\Domain\View\Search\DeceasedSearchView;
use App\Main\Infrastructure\Query\Frontpage\DeceasedSearchPaginatedListQueryInterface;
use App\Main\Infrastructure\Query\Frontpage\GetGraveViewInterface;
use App\Main\UI\Form\Person\PersonSearchType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class FrontpageController extends AbstractController
{
    public function index(): Response
    {
        $searchForm = $this->createForm(PersonSearchType::class);

        return $this->render('main/frontpage/index.html.twig', [
            'form' => $searchForm->createView(),
        ]);
    }

    /**
     * @throws Exception
     */
    public function search(
        Request $request,
        DeceasedSearchPaginatedListQueryInterface $query,
    ): Response {
        $searchForm = $this->createForm(PersonSearchType::class);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $personView = $searchForm->getData();
        } else {
            try {
                $searchData = $request->query->all('person_search');
                $firstName = empty($searchData['firstName']) ? null : (string)$searchData['firstName'];
                $bornYear = empty($searchData['bornYear']) ? null : (int)$searchData['bornYear'];
                $deathYear = empty($searchData['deathYear']) ? null : (int)$searchData['deathYear'];

                $personView = new DeceasedSearchView(
                    $firstName,
                    $searchData['lastName'] ?? null,
                    $bornYear,
                    $deathYear,
                );
                $searchForm->setData($personView);
            } catch (Exception $e) {
                throw new Exception('Invalid born year or death year input!');
            }

        }
        $peopleList = $query->execute(
            1,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit'),
            $personView
        );

        return $this->render('main/frontpage/search.html.twig', [
            'form' => $searchForm->createView(),
            'pagination' => $peopleList,
        ]);
    }

    public function show(
        GetGraveViewInterface $query,
        string $id,
    ): Response {
        $graveView = $query->execute($id);
        return $this->render('main/frontpage/show.html.twig', [
            'grave' => $graveView,
        ]);
    }
}
