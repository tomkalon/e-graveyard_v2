<?php

namespace App\Admin\UI\Web\Controller\User;

use App\Admin\Infrastructure\Query\User\UserPaginatedListQueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    public function list(
        UserPaginatedListQueryInterface $query,
        Request                         $request,
        int                             $page
    ): Response
    {
        $paginatedUsersList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit'),
        );

        return $this->render('admin/user/admin/index.html.twig', [
            'pagination' => $paginatedUsersList
        ]);
    }
}
