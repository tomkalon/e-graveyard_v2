<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\UI\Web\Controller\Grave;

use App\Admin\Application\Command\Grave\GraveCommand;
use App\Admin\Application\Command\Grave\RemoveGraveCommand;
use App\Admin\Application\Command\Payment\Grave\PaymentGraveCommand;
use App\Admin\Application\Command\Person\PersonCommand;
use App\Admin\Domain\View\Grave\GraveFilterView;
use App\Admin\Domain\View\Grave\GraveView;
use App\Admin\Domain\View\Payment\PaymentGraveView;
use App\Admin\Domain\View\Person\PersonView;
use App\Admin\Infrastructure\Query\Grave\GetGraveInterface;
use App\Admin\Infrastructure\Query\Grave\GetGraveViewInterface;
use App\Admin\Infrastructure\Query\Grave\GravePaginatedListQueryInterface;
use App\Admin\Infrastructure\Query\Graveyard\GetGraveyard;
use App\Admin\UI\Form\Grave\GraveFilterType;
use App\Admin\UI\Form\Grave\GraveType;
use App\Admin\UI\Form\Payment\PaymentGraveType;
use App\Admin\UI\Form\Person\PersonType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class GraveController extends AbstractController
{
    public const GRAVE_INDEX_SESSION_KEY = 'admin_web_grave_index_get_data';

    /**
     * @throws Exception
     */
    public function index(
        Request                          $request,
        Session                          $session,
        GravePaginatedListQueryInterface $query,
        GetGraveyard                     $graveyardQuery,
        CommandBusInterface              $commandBus,
        int                              $page,
    ): Response {
        // add decease form
        $addDeceasedForm = $this->createForm(PersonType::class, new PersonView());
        $addDeceasedForm->handleRequest($request);

        // filter form
        $filterForm = $this->createForm(GraveFilterType::class);
        $filterForm->handleRequest($request);

        // ADD DECEASED form handler
        if ($addDeceasedForm->isSubmitted() and $addDeceasedForm->isValid()) {
            /** @var PersonView $person */
            $person = $addDeceasedForm->getData();

            // command bus
            $commandBus->dispatch(new PersonCommand($person));
            $id = $person->getGrave()->getId();
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['id' => $id],
            );
        }

        // FILTER form handler
        if ($filterForm->isSubmitted() and $filterForm->isValid()) {
            $graveView = $filterForm->getData();
        } else {
            try {
                $filterData = $request->query->all('grave_filter');
                $graveyard = empty($filterData['graveyard']) ? null : $graveyardQuery->execute($filterData['graveyard']); ;
                $sector = empty($filterData['sector']) ? null : (int) $filterData['sector'];
                $row = empty($filterData['row']) ? null : (int) $filterData['row'];
                $number = empty($filterData['number']) ? null : (int) $filterData['number'];

                $graveView = new GraveFilterView(
                    $graveyard,
                    $sector,
                    $row,
                    $number
                );

                $filterForm->setData($graveView);
            } catch (Exception $e) {
                throw new Exception('Invalid grave filter data!');
            }
        }

        $session->set(self::GRAVE_INDEX_SESSION_KEY, $request->query->all());

        // query
        $paginatedGravesList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit'),
            $graveView,
        );

        return $this->render('admin/grave/index.html.twig', [
            'pagination' => $paginatedGravesList,
            'addDeceasedForm' => $addDeceasedForm->createView(),
            'filterForm' => $filterForm->createView(),
        ]);
    }

    public function show(
        CommandBusInterface     $commandBus,
        Request                 $request,
        Session                 $session,
        GetGraveViewInterface   $getGraveView,
        GetGraveInterface       $getGrave,
        string                  $id,
    ): Response {
        // query
        $grave = $getGraveView->execute($id);
        $graveIndexFilter = $session->get(self::GRAVE_INDEX_SESSION_KEY);

        // add decease form
        $addDeceasedForm = $this->createForm(PersonType::class, new PersonView());
        $addDeceasedForm->handleRequest($request);

        // add payment form
        $addPaymentForm = $this->createForm(PaymentGraveType::class, new PaymentGraveView());
        $addPaymentForm->handleRequest($request);

        // form handler
        // ADD DECEASED
        if ($addDeceasedForm->isSubmitted() and $addDeceasedForm->isValid()) {
            /** @var PersonView $person */
            $person = $addDeceasedForm->getData();
            $person->setGrave($getGrave->execute($grave->getId()));
            // command bus
            $commandBus->dispatch(new PersonCommand($person));
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['id' => $id],
            );
        }

        // ADD PAYMENT
        if ($addPaymentForm->isSubmitted() and $addPaymentForm->isValid()) {
            /** @var PaymentGraveView $paymentGrave */
            $paymentGrave = $addPaymentForm->getData();
            $paymentGrave->setGrave($getGrave->execute($grave->getId()));

            // command bus
            $commandBus->dispatch(new PaymentGraveCommand($paymentGrave));
            return $this->redirectToRoute(
                'admin_web_grave_show',
                ['id' => $id],
            );
        }

        return $this->render('admin/grave/show.html.twig', [
            'grave' => $grave,
            'addDeceasedForm' => $addDeceasedForm->createView(),
            'addPaymentForm' => $addPaymentForm->createView(),
            'graveIndexParams' => $graveIndexFilter,
            'id' => $id,
        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request             $request,
    ): Response {
        $form = $this->createForm(GraveType::class, new GraveView());
        $form->handleRequest($request);

        // form handler
        if ($form->isSubmitted() and $form->isValid()) {
            /** @var GraveView $graveData */
            $graveData = $form->getData();
            $graveData->setId(Uuid::uuid4());

            // command bus
            $commandBus->dispatch(new GraveCommand($graveData));
            return $this->redirectToRoute('admin_web_grave_show', ['id' => $graveData->getId()]);
        }

        return $this->render('admin/grave/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(
        CommandBusInterface     $commandBus,
        Request                 $request,
        GetGraveViewInterface   $getGraveView,
        string                  $id,
    ): Response {
        // query
        $grave = $getGraveView->execute($id);

        // create grave form
        $form = $this->createForm(GraveType::class, $grave);
        $form->handleRequest($request);

        // form handler
        if ($form->isSubmitted() and $form->isValid()) {
            $graveData = $form->getData();
            $mainImage = $form->get('images')->getData();

            // command bus
            $commandBus->dispatch(new GraveCommand($graveData, $mainImage));
            return $this->redirectToRoute('admin_web_grave_show', ['id' => $graveData->getId()]);
        }

        return $this->render('admin/grave/edit.html.twig', [
            'form' => $form->createView(),
            'id' => $grave->getId(),
        ]);
    }

    public function remove(
        string              $id,
        CommandBusInterface $commandBus,
    ): Response {
        // command bus
        $commandBus->dispatch(new RemoveGraveCommand($id));
        return $this->redirectToRoute('admin_web_grave_index');
    }
}
