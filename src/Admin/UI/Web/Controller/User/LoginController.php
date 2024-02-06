<?php

namespace App\Admin\UI\Web\Controller\User;

use App\Admin\UI\Form\User\UserInvitationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class LoginController extends AbstractController
{
    public function login(AuthenticationUtils $authenticationUtils): Response
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
        $response = $security->logout();

        // ... return $response (if set) or e.g. redirect to the homepage
        return $this->redirect('main_web_index');
    }

    public function register(
        string $token,
        CacheInterface $cache
    ): Response
    {
        $email = $cache->getItem($token)->get();
        if ($email) {
            $this->createForm(UserInvitationType::class);
        } else {
            throw new NotFoundHttpException('Token not found or expired.');
        }


        return $this->render('admin/user/register.html.twig');
    }

}
