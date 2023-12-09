<?php

namespace App\Main\UI\Web\Controller\Grave;

use App\Core\CQRS\CommandBus\CommandBusInterface;
use App\Main\Domain\Dto\Grave\GraveDto;
use App\Main\Domain\Form\Grave\CreateGraveType;
use App\Main\Infrastructure\CommandBus\Grave\CreateGraveCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('Main/Grave/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    public function create(
        CommandBusInterface $commandBus,
        Request             $request
    ): Response
    {
        $form = $this->createForm(CreateGraveType::class, new GraveDto());
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $dto = $form->getData();
            $commandBus->dispatch(new CreateGraveCommand($dto));

            return $this->redirectToRoute(
                'main_web_grave_index',
                [],
                Response::HTTP_CREATED
            );
        }

        return $this->render('Main/Grave/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
