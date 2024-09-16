<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\UI\Web\Controller\Graveyard;

use App\Admin\Application\Command\Graveyard\GraveyardCommand;
use App\Admin\Domain\View\Graveyard\GraveyardView;
use App\Admin\Infrastructure\Query\Graveyard\GetGraveyardViewInterface;
use App\Admin\Infrastructure\Query\Graveyard\GraveyardPaginatedListQueryInterface;
use App\Admin\UI\Form\Graveyard\GraveyardType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Enum\UserRoleEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveyardController extends AbstractController
{
    public function index(
        Request $request,
        GraveyardPaginatedListQueryInterface $query,
        int $page,
    ): Response {
        if (!$this->isGranted(UserRoleEnum::ADMIN->value)) {
            throw new AccessDeniedException('Access denied.');
        }
        $paginatedGraveyardsList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit'),
        );

        return $this->render('admin/graveyard/index.html.twig', [
            'pagination' => $paginatedGraveyardsList,

        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request             $request,
    ): Response {
        if (!$this->isGranted(UserRoleEnum::ADMIN->value)) {
            throw new AccessDeniedException('Access denied.');
        }

        $form = $this->createForm(
            GraveyardType::class,
            new GraveyardView(),
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $graveyard = $form->getData();
            $commandBus->dispatch(new GraveyardCommand($graveyard));
            return $this->redirectToRoute(
                'admin_web_graveyard_index',
            );
        }

        return $this->render('admin/graveyard/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(
        CommandBusInterface         $commandBus,
        Request                     $request,
        GetGraveyardViewInterface   $query,
        string                      $id,
    ): Response {
        if (!$this->isGranted(UserRoleEnum::ADMIN->value)) {
            throw new AccessDeniedException('Access denied.');
        }

        $graveyard = $query->execute($id);
        $form = $this->createForm(
            GraveyardType::class,
            $graveyard,
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $graveyard = $form->getData();
            $commandBus->dispatch(new GraveyardCommand($graveyard));
            return $this->redirectToRoute(
                'admin_web_graveyard_index',
            );
        }

        return $this->render('admin/graveyard/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
