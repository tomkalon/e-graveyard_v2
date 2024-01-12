<?php

namespace App\Admin\UI\Web\Controller\Grave;

use App\Admin\Application\Command\Grave\GraveCommand;
use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Application\Command\Payment\Grave\PaymentGraveCommand;
use App\Admin\Application\Command\Person\PersonCommand;
use App\Admin\Application\Dto\Grave\GraveDto;
use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use App\Admin\Application\Dto\Person\PersonDto;
use App\Admin\Infrastructure\Query\Grave\GetGraveInterface;
use App\Admin\Infrastructure\Query\Grave\GravePaginatedListQueryInterface;
use App\Admin\UI\Form\Grave\GraveType;
use App\Admin\UI\Form\Payment\PaymentGraveType;
use App\Admin\UI\Form\Person\PersonType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraveController extends AbstractController
{
    public function index(
        Request                          $request,
        GravePaginatedListQueryInterface $query,
        CommandBusInterface              $commandBus,
        int                              $page
    ): Response {

        // add decease form
        $addDeceasedForm = $this->createForm(
            PersonType::class,
            new PersonDto()
        );
        $addDeceasedForm->handleRequest($request);

        // query
        $paginatedGravesList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit')
        );

        // form handler
        if ($addDeceasedForm->isSubmitted() and $addDeceasedForm->isValid()) {
            /** @var PersonDto $data */
            $data = $addDeceasedForm->getData();

            // command bus
            $commandBus->dispatch(new PersonCommand($data));
            $id = $data->grave->getId();
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['id' => $id]
            );
        }

        return $this->render('admin/grave/index.html.twig', [
            'pagination' => $paginatedGravesList,
            'addDeceasedForm' => $addDeceasedForm->createView()
        ]);
    }

    public function show(
        GetGraveInterface   $query,
        CommandBusInterface $commandBus,
        Request             $request,
        string              $id
    ): Response {

        // add decease form
        $addDeceasedForm = $this->createForm(
            PersonType::class,
            new PersonDto()
        );
        $addDeceasedForm->handleRequest($request);

        // add payment form
        $addPaymentForm = $this->createForm(
            PaymentGraveType::class,
            new PaymentGraveDto()
        );
        $addPaymentForm->handleRequest($request);

        // query
        $grave = $query->execute($id);

        // form handler
        if ($addDeceasedForm->isSubmitted() and $addDeceasedForm->isValid()) {
            /** @var PersonDto $dto */
            $dto = $addDeceasedForm->getData();
            $dto->setGrave($grave);

            // command bus
            $commandBus->dispatch(new PersonCommand($dto));
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['id' => $id]
            );
        }

        if ($addPaymentForm->isSubmitted() and $addPaymentForm->isValid()) {
            /** @var PaymentGraveDto $dto */
            $dto = $addPaymentForm->getData();
            $dto->setGrave($grave);

            // command bus
            $commandBus->dispatch(new PaymentGraveCommand($dto));
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['id' => $id]
            );
        }

        return $this->render('admin/grave/show.html.twig', [
            'grave' => GraveDto::fromEntity($grave),
            'addDeceasedForm' => $addDeceasedForm->createView(),
            'addPaymentForm' => $addPaymentForm->createView(),
            'id' => $id
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

        // form handler
        if ($form->isSubmitted() and $form->isValid()) {
            $dto = $form->getData();

            // command bus
            $commandBus->dispatch(new GraveCommand($dto));
        }

        return $this->render('admin/grave/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function edit(
        GetGraveInterface   $query,
        CommandBusInterface $commandBus,
        Request             $request,
        string              $id
    ): Response {
        // query
        $dto = GraveDto::fromEntity($query->execute($id));

        $form = $this->createForm(
            GraveType::class,
            $dto
        );
        $form->handleRequest($request);

        // form handler
        if ($form->isSubmitted() and $form->isValid()) {
            $dto = $form->getData();

            // command bus
            $commandBus->dispatch(new GraveCommand($dto, $id));
            return $this->redirectToRoute('admin_web_grave_show', ['id' => $id]);
        }

        return $this->render('admin/grave/edit.html.twig', [
            'form' => $form->createView(),
            'id' => $id
        ]);
    }

    public function remove(
        string              $id,
        CommandBusInterface $commandBus
    ): Response {
        // command bus
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return $this->redirectToRoute('admin_web_grave_index');
    }
}
