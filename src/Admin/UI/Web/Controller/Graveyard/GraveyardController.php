<?php

namespace App\Admin\UI\Web\Controller\Graveyard;

use App\Admin\Application\Command\Grave\GraveCommand;
use App\Admin\Application\Command\Graveyard\GraveyardCommand;
use App\Admin\Application\Dto\Graveyard\GraveyardDto;
use App\Admin\Infrastructure\Query\Graveyard\GraveyardPaginatedListQueryInterface;
use App\Admin\UI\Form\Graveyard\GraveyardType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveyardController extends AbstractController
{
    public function index(
        Request $request,
        GraveyardPaginatedListQueryInterface $query,
        int $page
    ): Response {
        $paginatedGraveyardsList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit')
        );

        return $this->render('Admin/Graveyard/index.html.twig', [
            'pagination' => $paginatedGraveyardsList,

        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request             $request
    ): Response {

        $form = $this->createForm(
            GraveyardType::class,
            new GraveyardDto()
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $dto = $form->getData();
            $commandBus->dispatch(new GraveyardCommand($dto));

            return $this->redirectToRoute(
                'admin_web_graveyard_index'
            );
        }

        return $this->render('Admin/Graveyard/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
