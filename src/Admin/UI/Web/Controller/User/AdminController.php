<?php

namespace App\Admin\UI\Web\Controller\User;

use App\Admin\Application\Command\User\SendRegistrationLinkCommand;
use App\Admin\Application\Command\User\UpdateUserCommand;
use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Query\User\UserPaginatedListQueryInterface;
use App\Admin\UI\Form\User\ChangeRoleType;
use App\Admin\UI\Form\User\UserInvitationType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\UserRoleEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends AbstractController
{
    public function list(
        UserPaginatedListQueryInterface $query,
        Request                         $request,
        CommandBusInterface             $commandBus,
        int                             $page
    ): Response
    {
        if (!$this->isGranted(UserRoleEnum::ADMIN->value)) {
            throw new AccessDeniedException('Access denied.');
        }
        /** @var User $user */
        $user = $this->getUser();
        $paginatedUsersList = $query->execute(
            $page,
            $request->request->all('pagination_limit')['limit'] ?? $request->getSession()->get('pagination_limit'),
        );

        $changePermissionForm = $this->createForm(ChangeRoleType::class);
        $changePermissionForm->handleRequest($request);

        if ($changePermissionForm->isSubmitted() and $changePermissionForm->isValid()) {
            $userView = $changePermissionForm->getData();
            $role = $userView->getRoles();
            $userView->setRoles([$role]);
            $commandBus->dispatch(new UpdateUserCommand($userView));
            return $this->redirectToRoute('admin_web_user_list');
        }

        return $this->render('admin/user/admin/user_list.html.twig', [
            'pagination' => $paginatedUsersList,
            'change_permission_form' => $changePermissionForm->createView(),
            'adminID' => $user->getId()
        ]);
    }

    public function create(
        Request $request,
        CommandBusInterface $commandBus
    ): Response
    {
        if (!$this->isGranted(UserRoleEnum::ADMIN->value)) {
            throw new AccessDeniedException('Access denied.');
        }
        $userForm = $this->createForm(UserInvitationType::class, new UserView());
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() and $userForm->isValid()) {
            $userView = $userForm->getData();
            $commandBus->dispatch(new SendRegistrationLinkCommand($userView));
            return $this->redirectToRoute('admin_web_user_list');
        }

        return $this->render('admin/user/admin/send_invitation.html.twig', [
            'form' => $userForm->createView()
        ]);
    }
}
