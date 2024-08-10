<?php

namespace App\Admin\Application\Command\User;

use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Service\Security\LinkGeneratorServiceInterface;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Infrastructure\Utility\TimeConverter\TimeConverterUtilityInterface;
use LogicException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class ResetPasswordCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TokenStorageInterface         $tokenStorage,
        private LinkGeneratorServiceInterface $linkGeneratorService,
        private LoggerInterface               $userLogger,
        private TimeConverterUtilityInterface $timeConverterUtility,
        private TranslatorInterface           $translator,
        private MailerInterface               $mailer,
        private NotificationInterface         $notification,
        private string                        $senderEmail,
        private string                        $senderName,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(ResetPasswordCommand $command): void
    {
        $userView = $command->getUserView();
        $token = $this->tokenStorage->getToken();
        if ($token) {
            /** @var User $user */
            $user = $token->getUser();
        } else {
            throw new LogicException('No permission. Admin not logged in.');
        }

        $link = $this->linkGeneratorService->generate(
            'app_reset_password',
            $userView->getId(),
            6000,
            30,
            'generated_reset_password_link_'
        );
        $expiration = $this->timeConverterUtility->convert(600);

        $email = (new TemplatedEmail())
            ->from(new Address($this->senderEmail, $this->senderName))
            ->to($userView->getEmail())
            ->subject($this->translator->trans('email.reset_user_password.subject', [], 'email'))
            ->htmlTemplate('core/email/reset_user_password.html.twig')
            ->context([
                'link' => $link,
                'hello' => $this->translator->trans('email.common.hello', [
                    '%name%' => $userView->getUsername(),
                ], 'email'),
                'expiration' => $this->translator->trans('email.common.expiration', [
                    '%expiration%' => $expiration,
                ], 'email')
            ]);
        $this->mailer->send($email);
        $this->userLogger->info('Reset password command received', [
            'email' => $command->getUserView()->getEmail(),
            'admin' => $user->getUsername(),
        ]);
        $this->notification->addNotification('notification', new NotificationDto(
            'notification.user.reset_password.label',
            NotificationTypeEnum::SUCCESS,
            $this->translator->trans('notification.user.reset_password.success', [
                '%email%' => $userView->getEmail(),
            ], 'flash'),
        ));
    }
}
