<?php

namespace App\Admin\UI\Web\Controller\User;

use App\Admin\Application\Command\User\SendRegistrationLinkCommand;
use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Query\User\UserPaginatedListQueryInterface;
use App\Admin\UI\Form\User\UserType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Trait\CheckAdminPermissionTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends AbstractController
{
    use CheckAdminPermissionTrait;

    public function list(
        UserPaginatedListQueryInterface $query,
        Request                         $request,
        Security                        $security,
        int                             $page
    ): Response
    {
        /** @var User $user */
        $user = $security->getUser();

        $paginatedUsersList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit'),
        );

        return $this->render('admin/user/admin/user_list.html.twig', [
            'pagination' => $paginatedUsersList,
            'adminID' => $user->getId()
        ]);
    }

    public function create(
        Request $request,
        CommandBusInterface $commandBus
    ): Response
    {
        $userForm = $this->createForm(UserType::class, new UserView());
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() and $userForm->isValid()) {
            $userView = $userForm->getData();
            $commandBus->dispatch(new SendRegistrationLinkCommand($userView));
        }

        return $this->render('admin/user/admin/create.html.twig', [
            'form' => $userForm->createView()
        ]);
    }
}
