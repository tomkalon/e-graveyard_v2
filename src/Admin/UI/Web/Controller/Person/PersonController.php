<?php

namespace App\Admin\UI\Web\Controller\Person;

use App\Admin\Infrastructure\Query\Person\PersonPaginatedListQueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends AbstractController
{
    public function index(
        Request $request,
        PersonPaginatedListQueryInterface $query,
        int $page
    ): Response {
        $paginatedPeopleList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit')
        );

        return $this->render('admin/person/index.html.twig', [
            'pagination' => $paginatedPeopleList,
        ]);
    }
}
