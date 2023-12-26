<?php

namespace App\Admin\UI\Web\Controller\Grave;

use App\Admin\Infrastructure\Query\Grave\GravePaginatedListQueryInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Infrastructure\Utility\Pagination\Form\PaginationLimitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    public function index(
        Request $request,
        GravePaginatedListQueryInterface $query,
        int $page
    ): Response {

        $limitForm = $this->createForm(PaginationLimitType::class);
        $limitForm->handleRequest($request);

        $paginatedGraveList = $query->execute(
            $page,
            $limitForm
        );

        return $this->render('Admin/Grave/index.html.twig', [
            'pagination' => $paginatedGraveList
        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request             $request
    ): Response {
        $form = $this->createForm(
            \App\Admin\UI\Form\Grave\CreateGraveType::class,
            new \App\Admin\Application\Dto\Grave\GraveDto()
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $dto = $form->getData();
            $commandBus->dispatch(new \App\Admin\Application\Command\Grave\CreateGraveCommand($dto));

            return $this->redirectToRoute(
                'admin_web_grave_index',
                [],
                Response::HTTP_CREATED
            );
        }

        return $this->render('Admin/Grave/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
