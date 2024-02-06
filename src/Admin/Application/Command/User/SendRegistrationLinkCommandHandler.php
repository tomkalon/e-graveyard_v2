<?php

namespace App\Admin\Application\Command\User;

use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Service\Security\LinkGeneratorServiceInterface;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\Enum\TimeUnitsEnum;
use App\Core\Infrastructure\Utility\TimeConverter\TimeConverterUtilityInterface;
use LogicException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class SendRegistrationLinkCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TokenStorageInterface         $tokenStorage,
        private LinkGeneratorServiceInterface $linkGeneratorService,
        private LoggerInterface               $userLogger,
        private TranslatorInterface           $translator,
        private MailerInterface               $mailer,
        private TimeConverterUtilityInterface $timeConverterUtility,
        private NotificationInterface         $notification,
        private string                        $linkExpiration,
        private string                        $senderEmail,
        private string                        $senderName,
        private string                        $appTitle
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(SendRegistrationLinkCommand $command): void
    {
        $userView = $command->getUserView();
        $token = $this->tokenStorage->getToken();
        if ($token) {
            /** @var User $user */
            $user = $token->getUser();
        } else {
            throw new LogicException('No permission. Admin not logged in.');
        }

        $link = $this->linkGeneratorService->generate('app_register', $userView->getEmail(), $this->linkExpiration, 30, 'generated_register_link_');

        $expiration = $this->timeConverterUtility->convertSecondsToTime($this->linkExpiration, TimeUnitsEnum::HOUR);

        $email = (new TemplatedEmail())
            ->from(new Address($this->senderEmail, $this->senderName))
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
        $this->userLogger->notice(sprintf('Registration link sent to %s by %s', $userView->getEmail(), $user->getUsername()));
        $this->notification->addNotification('notification', new NotificationDto(
            'notification.user.invitation.label',
            NotificationTypeEnum::SUCCESS,
            $this->translator->trans('notification.user.invitation.success', [
                '%email%' => $userView->getEmail(),
            ], 'flash'),
        ));

    }
}
