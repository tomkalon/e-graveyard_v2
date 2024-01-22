<?php

namespace App\Admin\UI\Web\Controller\Grave;

use App\Admin\Application\Command\Grave\GraveCommand;
use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Application\Command\Payment\Grave\PaymentGraveCommand;
use App\Admin\Application\Command\Person\PersonCommand;
use App\Admin\Infrastructure\Query\Grave\GravePaginatedListQueryInterface;
use App\Admin\UI\Form\Grave\GraveType;
use App\Admin\UI\Form\Payment\PaymentGraveType;
use App\Admin\UI\Form\Person\PersonType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Entity\Person;
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
            new Person()
        );
        $addDeceasedForm->handleRequest($request);

        // query
        $paginatedGravesList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit')
        );

        // form handler
        if ($addDeceasedForm->isSubmitted() and $addDeceasedForm->isValid()) {
            /** @var Person $person */
            $person = $addDeceasedForm->getData();

            // command bus
            $commandBus->dispatch(new PersonCommand($person));
            $id = $person->getGrave()->getId();
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['grave' => $id]
            );
        }

        return $this->render('admin/grave/index.html.twig', [
            'pagination' => $paginatedGravesList,
            'addDeceasedForm' => $addDeceasedForm->createView()
        ]);
    }

    public function show(
        CommandBusInterface $commandBus,
        Request             $request,
        Grave               $grave
    ): Response {

        // add decease form
        $addDeceasedForm = $this->createForm(
            PersonType::class,
            new Person()
        );
        $addDeceasedForm->handleRequest($request);

        // add payment form
        $addPaymentForm = $this->createForm(
            PaymentGraveType::class,
            new PaymentGrave()
        );
        $addPaymentForm->handleRequest($request);

        // form handler
        // ADD DECEASED
        if ($addDeceasedForm->isSubmitted() and $addDeceasedForm->isValid()) {
            /** @var Person $person */
            $person = $addDeceasedForm->getData();
            $person->setGrave($grave);
            // command bus
            $commandBus->dispatch(new PersonCommand($person));
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['grave' => $grave->getId()]
            );
        }

        // ADD PAYMENT
        if ($addPaymentForm->isSubmitted() and $addPaymentForm->isValid()) {
            /** @var PaymentGrave $paymentGrave */
            $paymentGrave = $addPaymentForm->getData();
            $paymentGrave->setGrave($grave);

            // command bus
            $commandBus->dispatch(new PaymentGraveCommand($paymentGrave));
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['grave' => $grave->getId()]
            );
        }

        return $this->render('admin/grave/show.html.twig', [
            'grave' => $grave,
            'addDeceasedForm' => $addDeceasedForm->createView(),
            'addPaymentForm' => $addPaymentForm->createView(),
            'id' => $grave->getId()
        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request             $request
    ): Response {
        $form = $this->createForm(
            GraveType::class,
            new Grave()
        );
        $form->handleRequest($request);

        // form handler
        if ($form->isSubmitted() and $form->isValid()) {
            $graveData = $form->getData();

            // command bus
            $commandBus->dispatch(new GraveCommand($graveData));
            return $this->redirectToRoute('admin_web_grave_show', ['grave' => $graveData->getId()]);
        }

        return $this->render('admin/grave/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function edit(
        CommandBusInterface  $commandBus,
        Request              $request,
        Grave                $grave
    ): Response {
        // query
        $form = $this->createForm(
            GraveType::class,
            $grave
        );
        $form->handleRequest($request);

        // form handler
        if ($form->isSubmitted() and $form->isValid()) {
            $graveData = $form->getData();
            $mainImage = $form->get('images')->getData();

            // command bus
            $commandBus->dispatch(new GraveCommand($graveData, $mainImage));
            return $this->redirectToRoute('admin_web_grave_show', ['grave' => $graveData->getId()]);
        }

        return $this->render('admin/grave/edit.html.twig', [
            'form' => $form->createView(),
            'id' => $grave->getId()
        ]);
    }

    public function remove(
        Grave               $grave,
        CommandBusInterface $commandBus
    ): Response {
        // command bus
        $commandBus->dispatch(new RemoveGraveCommand($grave));
        return $this->redirectToRoute('admin_web_grave_index');
    }
}
