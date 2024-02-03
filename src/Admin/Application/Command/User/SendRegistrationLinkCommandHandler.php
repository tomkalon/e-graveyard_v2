<?php

namespace App\Admin\Application\Command\User;

use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\Service\Security\LinkGeneratorServiceInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Contracts\Translation\TranslatorInterface;

class SendRegistrationLinkCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly LinkGeneratorServiceInterface $linkGeneratorService,
        private readonly TranslatorInterface $translator,
        private readonly string $linkExpiration,
        private readonly string $senderEmail,
        private readonly string $senderName,
        private readonly string $appTitle,
    ) {
    }

    public function __invoke(SendRegistrationLinkCommand $command): void
    {
        $userView = $command->getUserView();

        $link = $this->linkGeneratorService->generate('app_register', $this->linkExpiration, null, 'generated_register_link_');
        $email = (new TemplatedEmail())
            ->from($this->senderEmail, $this->senderName)
            ->to($userView->getEmail())
            ->subject($this->translator->trans('email.new_account.registration_link.subject', [], 'email'))
            ->htmlTemplate('core/email/new_account.html.twig')
            ->context([
                'link' => $link,
                'hello' => $this->translator->trans('email.new_account.registration_link.hello', [
                    '%name%' => $userView->getUsername(),
                ], 'email'),
                'content' => $this->translator->trans('email.new_account.registration_link.content', [], 'email'),
                'expiration' => $this->translator->trans('email.new_account.registration_link.expiration', [], 'email'),
                'link_button' => $this->translator->trans('email.new_account.registration_link.link_button', [], 'email'),
                'regards' => $this->translator->trans('email.new_account.registration_link.regards', [
                    '%app_title%' => $this->appTitle,
                ], 'email'),
            ]);
    }
}
