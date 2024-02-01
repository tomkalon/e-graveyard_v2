<?php

namespace App\Admin\UI\Web\Controller\User;

use App\Admin\Application\Command\User\ChangeUserPasswordCommand;
use App\Admin\Domain\View\User\UserView;
use App\Admin\UI\Form\User\ChangePasswordType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function show(Security $security): Response
    {
        /** @var User $user */
        $user = $security->getUser();
        $userView = UserView::fromEntity($user);
        return $this->render('admin/user/show.html.twig', [
            'user' => $user
        ]);
    }

    public function changePassword(
        CommandBusInterface $commandBus,
        Request $request
    ): Response
    {
        $changePasswordForm = $this->createForm(ChangePasswordType::class, new UserView());
        $changePasswordForm->handleRequest($request);

        if ($changePasswordForm->isSubmitted() and $changePasswordForm->isValid()) {
            $userView = $changePasswordForm->getData();
            $commandBus->dispatch(new ChangeUserPasswordCommand($userView));
            return $this->redirectToRoute('admin_web_user_show');
        }

        return $this->render('admin/user/change_password.html.twig', [
            'form' => $changePasswordForm->createView()
        ]);
    }
}
