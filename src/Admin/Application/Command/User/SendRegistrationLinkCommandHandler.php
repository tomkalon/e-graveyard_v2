<?php

namespace App\Admin\Application\Command\User;

use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\Service\Security\LinkGeneratorServiceInterface;
use App\Core\Domain\Enum\TimeUnitsEnum;
use App\Core\Infrastructure\Utility\TimeConverter\TimeConverterUtilityInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Contracts\Translation\TranslatorInterface;

class SendRegistrationLinkCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly LinkGeneratorServiceInterface $linkGeneratorService,
        private readonly TranslatorInterface $translator,
        private readonly MailerInterface $mailer,
        private readonly TimeConverterUtilityInterface $timeConverterUtility,
        private readonly string $linkExpiration,
        private readonly string $senderEmail,
        private readonly string $senderName,
        private readonly string $appTitle,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(SendRegistrationLinkCommand $command): void
    {
        $userView = $command->getUserView();

        $link = $this->linkGeneratorService->generate('app_register', $userView->getEmail(), $this->linkExpiration, null, 'generated_register_link_');

        $expiration = $this->timeConverterUtility->convertSecondsToTime($this->linkExpiration, TimeUnitsEnum::HOUR);

        $email = (new TemplatedEmail())
            ->from(new Address($this->senderEmail,$this->senderName))
            ->to($userView->getEmail())
            ->subject($this->translator->trans('email.new_account.registration_link.subject', [], 'email'))
            ->htmlTemplate('core/email/new_account.html.twig')
            ->context([
                'link' => $link,
                'hello' => $this->translator->trans('email.new_account.registration_link.hello', [
                    '%name%' => $userView->getFirstName(),
                ], 'email'),
                'content' => $this->translator->trans('email.new_account.registration_link.content', [], 'email'),
                'expiration' => $this->translator->trans('email.new_account.registration_link.expiration', [
                    '%expiration%' => $expiration,
                ], 'email'),
                'link_button' => $this->translator->trans('email.new_account.registration_link.link_button', [], 'email'),
                'regards' => $this->translator->trans('email.new_account.registration_link.regards', [
                    '%app_title%' => $this->appTitle,
                ], 'email'),
            ]);

        $this->mailer->send($email);
    }
}