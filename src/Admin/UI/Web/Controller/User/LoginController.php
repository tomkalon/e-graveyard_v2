<?php

namespace App\Admin\UI\Web\Controller\User;

use App\Admin\Application\Command\User\CreateUserCommand;
use App\Admin\Application\Command\User\UpdateUserCommand;
use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Query\User\GetUserInterface;
use App\Admin\Infrastructure\Query\User\UserByFieldsQueryInterface;
use App\Admin\UI\Form\User\ChangePasswordType;
use App\Admin\UI\Form\User\UserType;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Exception;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
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
     * @throws Exception
     */
    public function register(
        string $token,
        UserByFieldsQueryInterface $query,
        CommandBusInterface $commandBus,
        TokenStorageInterface $tokenStorage,
        SessionInterface $session,
        NotificationInterface $notification,
        CacheInterface $cache,
        Request $request
    ): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user) {
            $cache->delete($token);
            $notification->addNotification('notification', new NotificationDto(
                'notification.user.create.label',
                NotificationTypeEnum::SUCCESS,
                'notification.user.create.failed.already_logged_in'
            ));
            return $this->redirectToRoute('admin_web_user_index');
        }

        $email = $cache->getItem($token)->get();
        if ($email) {
            $userView = new UserView();
            $userView->setEmail($email);
            $form = $this->createForm(UserType::class, $userView);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $userView = $form->getData();
                $commandBus->dispatch(new CreateUserCommand($userView));

                // Login after registration
                /** @var User $user */
                $user = $query->execute($userView)[0];
                $authToken = new UsernamePasswordToken($user, 'main', $user->getRoles());
                $tokenStorage->setToken($authToken);
                $session->set('_security_main', serialize($authToken));

                $cache->delete($token);
                return $this->redirectToRoute('admin_web_user_index');
            }
        } else {
            throw new Exception('Token not found or expired.');
        }

        return $this->render('admin/user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function resetPassword(
        string $token,
        CommandBusInterface $commandBus,
        TokenStorageInterface $tokenStorage,
        SessionInterface $session,
        NotificationInterface $notification,
        CacheInterface $cache,
        GetUserInterface $query,
        Request $request
    ): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user) {
            $cache->delete($token);
            $notification->addNotification('notification', new NotificationDto(
                'notification.user.reset_password.label',
                NotificationTypeEnum::SUCCESS,
                'notification.user.reset_password.failed.already_logged_in'
            ));
            return $this->redirectToRoute('admin_web_user_index');
        }

        $userId = $cache->getItem($token)->get();

        if ($userId) {
            $user = $query->execute($userId);
            $userView = UserView::fromEntity($user);
            $userView->setId($userId);
            $form = $this->createForm(ChangePasswordType::class, $userView);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $userView = $form->getData();
                $commandBus->dispatch(new UpdateUserCommand($userView));

                // Login after password reset
                /** @var User $user */
                $authToken = new UsernamePasswordToken($user, 'main', $user->getRoles());
                $tokenStorage->setToken($authToken);
                $session->set('_security_main', serialize($authToken));

                $cache->delete($token);
                return $this->redirectToRoute('admin_web_user_index');
            }
        } else {
            throw new Exception('Token not found or expired.');
        }

        return $this->render('admin/user/reset_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
