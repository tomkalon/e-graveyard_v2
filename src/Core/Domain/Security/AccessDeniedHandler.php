<?php

namespace App\Core\Domain\Security;


use App\Core\Domain\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

readonly class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private TokenStorageInterface $tokenStorage
    ) {
    }
    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {
        $token = $this->tokenStorage->getToken();
        if ($token) {
            return new RedirectResponse($this->urlGenerator->generate('admin_web_user_index'));
        } else {
            return new RedirectResponse($this->urlGenerator->generate('main_web_index'));
        }
    }
}
