<?php

namespace App\Main\UI\Cli;

use App\Core\CQRS\CommandBus\CommandBusInterface;
use App\Core\CQRS\QueryBus\QueryBusInterface;
use App\Main\Domain\Dto\User\UserDto;
use App\Main\Infrastructure\CommandBus\User\SaveUser;
use App\Main\Infrastructure\QueryBus\User\GetUsersByOptionsQuery;
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
    name: 'user:add',
    description: 'Create New User',
)]
class UserAddCommand extends Command
{
    const ADD_NEW_USER = 'Dodawanie nowego użytkownika.';
    const SUCCESS_USER_CREATED = 'Konto zostało utworzone: nazwa użytkownika -> ';
    const FAILURE_EMAIL_ALREADY_EXIST = 'Utworzenie nowego użytkownika zostało anulowane! Email jest już zajęty.';
    const FAILURE_EMAIL_ERROR = 'Utworzenie nowego użytkownika zostało anulowane! Wpisany email jest niepoprawny.';
    const FAILURE_USERNAME_ALREADY_EXIST = 'Utworzenie nowego użytkownika zostało anulowane! Podana nazwa użytkownika jest już zajęta';
    const FAILURE_USERNAME_ERROR = 'Utworzenie nowego użytkownika zostało anulowane! Błędna nazwa użytkownika.';
    const FAILURE_PASSWORD_TOO_SHORT = 'Utworzenie nowego użytkownika zostało anulowane! Hasło jest zbyt krótkie.';
    const FAILURE_PASSWORD_DONT_MATCH = 'Utworzenie nowego użytkownika zostało anulowane! Wprowadzone hasła różnią się.';

    public function __construct(
        private readonly QueryBusInterface   $queryBus,
        private readonly CommandBusInterface $commandBus,
        private readonly ValidatorInterface  $validator,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp(self::ADD_NEW_USER);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);
        $dto = new UserDto();

        // set email
        $email = $this->setEmail($input, $output);
        if ($email !== null) {
            $dto->setEmail($email);
        } else {
            return Command::FAILURE;
        }

        // set username
        $username = $this->setUsername($input, $output);
        if ($username !== null) {
            $dto->setUsername($username);
        } else {
            return Command::FAILURE;
        }

        // set password
        $password = $this->setPassword($input, $output);
        if ($password !== null) {
            $dto->setPassword($password);
        } else {
            return Command::FAILURE;
        }

        // persist
        $this->commandBus->dispatch(new SaveUser($dto));
        $io->success(sprintf(self::SUCCESS_USER_CREATED.'%s', $dto->getEmail()));
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
            new Email()
        ]);

        if (count($emailValidation)) {
            $io->error(self::FAILURE_EMAIL_ERROR);
            return null;
        }

        $dto = new UserDto($email);
        $isEmailExist = $this->queryBus->handle(new GetUsersByOptionsQuery($dto));

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
            'Nazwa użytkownika: ',
            false,
        );
        $username = $helper->ask($input, $output, $addUsername);
        $pattern = '/^[a-zA-Z0-9_-]+$/';
        $usernameValidation = $this->validator->validate($username, [
            new Regex([
                'pattern' => $pattern
            ]),
        ]);

        if (count($usernameValidation)) {
            $io->error(self::FAILURE_USERNAME_ERROR);
            return null;
        }

        $dto = new UserDto();
        $dto->setUsername($username);
        $isUsernameExist = $this->queryBus->handle(new GetUsersByOptionsQuery($dto));

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
            'Hasło (co najmniej 6 znaków): ',
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
            'Powtórz hasło: ',
            false,
        );
        $addPasswordRepeat->setHidden(true);
        $addPasswordRepeat->setHiddenFallback(false);
        $passwordRepeat = $helper->ask($input, $output, $addPasswordRepeat);
        if (strlen($passwordRepeat) < 6) {
            $io->error(self::FAILURE_PASSWORD_TOO_SHORT);
            return null;
        } else if ($password !== $passwordRepeat) {
            $io->error(self::FAILURE_PASSWORD_DONT_MATCH);
            return null;
        }

        return $password;
    }


}
