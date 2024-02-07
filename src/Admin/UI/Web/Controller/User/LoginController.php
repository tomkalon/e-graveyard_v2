<?php

namespace App\Admin\UI\Web\Controller\User;

use App\Admin\Application\Command\User\CreateUserCommand;
use App\Admin\Domain\View\User\UserView;
use App\Admin\UI\Form\User\UserType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Entity\User;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Cache\CacheInterface;

class LoginController extends AbstractController
{
    public function login(
        AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
    public function logout(Security $security): Response
    {
        // logout the user in on the current firewall
        $security->logout();

        // ... return $response (if set) or e.g. redirect to the homepage
        return $this->redirect('main_web_index');
    }

    /**
     * @throws InvalidArgumentException
     */
    public function register(
        string $token,
        CommandBusInterface $commandBus,
        CacheInterface $cache,
        Request $request
    ): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user) {
            return $this->redirectToRoute('admin_web_user_index');
        }

        $email = $cache->getItem($token)->get();
        if ($email) {
            $userView = new UserView();
            $userView->setEmail($email);
            $form = $this->createForm(UserType::class, $userView);
            $form->handleRequest($request);
        } else {
            throw new NotFoundHttpException('Token not found or expired.');
        }

        if ($form->isSubmitted() and $form->isValid()) {
            $userView = $form->getData();
            $commandBus->dispatch(new CreateUserCommand($userView));
            $cache->delete($token);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('admin/user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
