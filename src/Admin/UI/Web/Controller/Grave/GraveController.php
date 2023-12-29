<?php

namespace App\Admin\UI\Web\Controller\Grave;

use App\Admin\Application\Command\Grave\GraveCommand;
use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Infrastructure\Query\Grave\GravePaginatedListQueryInterface;
use App\Admin\UI\Form\Grave\GraveType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
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
        $paginatedGraveList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ??
                $request->getSession()->get('pagination_limit')
        );
        return $this->render('Admin/Grave/index.html.twig', [
            'pagination' => $paginatedGraveList,

        ]);
    }

    public function show(
        Request $request,
        string $id
    ): Response {
        $grave = null;
        return $this->render('Admin/Grave/show.html.twig', [
            'grave' => $grave,
        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request             $request
    ): Response {
        $form = $this->createForm(
            GraveType::class,
            new GraveDto()
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $dto = $form->getData();
            $commandBus->dispatch(new GraveCommand($dto));

            return $this->redirectToRoute(
                'admin_web_grave_index'
            );
        }

        return $this->render('Admin/Grave/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
