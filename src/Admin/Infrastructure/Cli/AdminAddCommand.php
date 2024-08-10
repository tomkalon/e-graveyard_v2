<?php

namespace App\Admin\Infrastructure\Cli;

use App\Admin\Application\Command\User\CreateUserCommand;
use App\Admin\Domain\View\User\UserView;
use App\Admin\Infrastructure\Query\User\UserByFieldsQueryInterface;
use App\Core\Application\CQRS\Command\CommandBusInterface;
use App\Core\Domain\Enum\UserRoleEnum;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'app:admin:add',
    description: 'Create New User',
)]
class AdminAddCommand extends Command
{
    public const ADD_NEW_USER = 'Adding a new user.';
    public const SUCCESS_USER_CREATED = 'The account has been created: username ->';
    public const FAILURE_EMAIL_ALREADY_EXIST = 'The new user creation was canceled!
     Email is already taken.';
    public const FAILURE_EMAIL_ERROR = 'The new user creation was canceled!
     The email address entered is incorrect.';
    public const FAILURE_USERNAME_ALREADY_EXIST = 'The new user creation was canceled!
     The username you entered is already taken.';
    public const FAILURE_USERNAME_ERROR = 'The new user creation was canceled!
     Invalid username.';
    public const FAILURE_PASSWORD_TOO_SHORT = 'The new user creation was canceled!
     The password is too short.';
    public const FAILURE_PASSWORD_DONT_MATCH = 'The new user creation was canceled!
     The passwords you entered differ.';

    public function __construct(
        private readonly UserByFieldsQueryInterface $query,
        private readonly CommandBusInterface        $commandBus,
        private readonly ValidatorInterface         $validator,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp(self::ADD_NEW_USER);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);
        $userView = new UserView();

        // set email
        $email = $this->setEmail($input, $output);
        if ($email !== null) {
            $userView->setEmail($email);
        } else {
            return Command::FAILURE;
        }

        // set username
        $username = $this->setUsername($input, $output);
        if ($username !== null) {
            $userView->setUsername($username);
        } else {
            return Command::FAILURE;
        }

        // set password
        $password = $this->setPassword($input, $output);
        if ($password !== null) {
            $userView->setPassword($password);
        } else {
            return Command::FAILURE;
        }

        $userView->setRoles([UserRoleEnum::ADMIN->value]);

        // persist
        $this->commandBus->dispatch(new CreateUserCommand($userView));
        $io->success(sprintf(self::SUCCESS_USER_CREATED . '%s', $userView->getEmail()));
        return Command::SUCCESS;
    }

    private function setEmail(InputInterface $input, OutputInterface $output): ?string
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        $addEmail = new Question(
            'Email: ',
            false,
        );
        $email = $helper->ask($input, $output, $addEmail);
        $emailValidation = $this->validator->validate($email, [
            new Email(),
        ]);


        if (count($emailValidation) or !$email) {
            $io->error(self::FAILURE_EMAIL_ERROR);
            return null;
        }

        $userView = new UserView();
        $userView->setEmail($email);
        $isEmailExist = $this->query->execute($userView);

        if ($isEmailExist) {
            $io->error(self::FAILURE_EMAIL_ALREADY_EXIST);
            return null;
        }

        return $email;
    }

    private function setUsername(InputInterface $input, OutputInterface $output): ?string
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        $addUsername = new Question(
            'Username: ',
            false,
        );
        $username = $helper->ask($input, $output, $addUsername);
        $pattern = '/^[a-zA-Z0-9_-]+$/';
        $usernameValidation = $this->validator->validate($username, [
            new Regex([
                'pattern' => $pattern,
            ]),
        ]);

        if (count($usernameValidation)) {
            $io->error(self::FAILURE_USERNAME_ERROR);
            return null;
        }

        $userView = new UserView();
        $userView->setUsername($username);
        $isUsernameExist = $this->query->execute($userView);

        if ($isUsernameExist) {
            $io->error(self::FAILURE_USERNAME_ALREADY_EXIST);
            return null;
        }

        return $username;
    }

    private function setPassword(InputInterface $input, OutputInterface $output): ?string
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        // set password
        $addPassword = new Question(
            'Password (at least 6 characters):',
            false,
        );
        $addPassword->setHidden(true);
        $addPassword->setHiddenFallback(false);
        $password = $helper->ask($input, $output, $addPassword);
        if (strlen($password) < 6) {
            $io->error(self::FAILURE_PASSWORD_TOO_SHORT);
            return null;
        }

        // set password repeat
        $addPasswordRepeat = new Question(
            'Repeat password:',
            false,
        );
        $addPasswordRepeat->setHidden(true);
        $addPasswordRepeat->setHiddenFallback(false);
        $passwordRepeat = $helper->ask($input, $output, $addPasswordRepeat);
        if (strlen($passwordRepeat) < 6) {
            $io->error(self::FAILURE_PASSWORD_TOO_SHORT);
            return null;
        } elseif ($password !== $passwordRepeat) {
            $io->error(self::FAILURE_PASSWORD_DONT_MATCH);
            return null;
        }

        return $password;
    }
}
