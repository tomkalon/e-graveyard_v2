<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\UI\Web\Controller\Person;

use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Admin\Domain\View\Person\PersonFilterView;
use App\Admin\Infrastructure\Query\Person\PersonPaginatedListQueryInterface;
use App\Admin\UI\Form\Person\PersonFilterType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends AbstractController
{
    /**
     * @throws Exception
     */
    public function index(
        Request $request,
        PersonPaginatedListQueryInterface $query,
        int $page,
    ): Response {
        $filterForm = $this->createForm(PersonFilterType::class);
        $filterForm->handleRequest($request);

        if ($filterForm->isSubmitted() and $filterForm->isValid()) {
            $personView = $filterForm->getData();
        } else {
            try {
                $filterData = $request->query->all('person_filter');
                $firstName = empty($filterData['firstName']) ? null : (string) $filterData['firstName'];
                $lastName = empty($filterData['lastName']) ? null : (string) $filterData['lastName'];
                $bornYear = empty($filterData['bornYear']) ? null : (int) $filterData['bornYear'];
                $deathYear = empty($filterData['deathYear']) ? null : (int) $filterData['deathYear'];

                $personView = new PersonFilterView(
                    $firstName,
                    $lastName,
                    $bornYear,
                    $deathYear,
                );

                $filterForm->setData($personView);
            } catch (Exception $e) {
                throw new Exception('Invalid grave filter data!');
            }
        }

        $paginatedPeopleList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit'),
            $personView,
        );

        return $this->render('admin/person/index.html.twig', [
            'pagination' => $paginatedPeopleList,
            'filterForm' => $filterForm->createView(),
        ]);
    }
}
