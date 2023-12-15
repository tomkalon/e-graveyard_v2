<?php

namespace App\Admin\UI\Web\Controller\Grave;

use App\Admin\Domain\Dto\Grave\GraveDto;
use App\Admin\Domain\Form\Grave\CreateGraveType;
use App\Admin\Infrastructure\CommandBus\Grave\CreateGraveCommand;
use App\Core\CQRS\CommandBus\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    public function index(
    ): Response
    {

        return $this->render('Admin/Grave/index.html.twig', [

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
