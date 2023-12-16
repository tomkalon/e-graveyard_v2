<?php

namespace App\Admin\UI\Web\Controller\Grave;

use App\Admin\Domain\Dto\Grave\GraveDto;
use App\Admin\Domain\Form\Grave\CreateGraveType;
use App\Admin\Domain\Form\Grave\GraveFilterType;
use App\Admin\Infrastructure\CommandBus\Grave\CreateGraveCommand;
use App\Admin\Infrastructure\QueryBus\Grave\GetGraveListQuery;
use App\Core\CQRS\CommandBus\CommandBusInterface;
use App\Core\CQRS\QueryBus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    public function index(
        Request $request,
        QueryBusInterface $queryBus,
    ): Response {



        $graveList = $queryBus->handle(new GetGraveListQuery());

        return $this->render('Admin/Grave/index.html.twig', [
            'gravesList' => $graveList
        ]);
    }


    public function create(
        CommandBusInterface $commandBus,
        Request             $request
    ): Response {
        $form = $this->createForm(
            CreateGraveType::class,
            new GraveDto()
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $dto = $form->getData();
            $commandBus->dispatch(new CreateGraveCommand($dto));

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
