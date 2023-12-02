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
            ->setHelp('Dodawanie nowego użytkownika.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        // set email
        $dto = new UserDto($this->setEmail($input, $output));

        // set username
        $dto->setUsername($this->setUsername($input, $output));

        // set password
        $dto->setPassword($this->setPassword($input, $output));

        // persist
        $this->commandBus->dispatch(new SaveUser($dto));
        $io->success(sprintf('Konto zostało utworzone: nazwa użytkownika -> %s', $dto->getEmail()));
        return Command::SUCCESS;
    }

    private function setEmail(InputInterface $input, OutputInterface $output): string
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
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Wpisany email jest niepoprawny.');
            return Command::FAILURE;
        }

        $dto = new UserDto($email);
        $isEmailExist = $this->queryBus->handle(new GetUsersByOptionsQuery($dto));

        if ($isEmailExist) {
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Email jest już zajęty.');
            return Command::FAILURE;
        }

        return $email;
    }

    private function setUsername(InputInterface $input, OutputInterface $output): string
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
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Błędna nazwa użytkownika.');
            return Command::FAILURE;
        }

        $dto = new UserDto();
        $dto->setUsername($username);
        $isUsernameExist = $this->queryBus->handle(new GetUsersByOptionsQuery($dto));

        if ($isUsernameExist) {
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Email jest już zajęty.');
            return Command::FAILURE;
        }

        return $username;
    }

    private function setPassword(InputInterface $input, OutputInterface $output): string
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
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Hasło jest zbyt krótkie.');
            return Command::FAILURE;
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
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Hasło jest zbyt krótkie.');
            return Command::FAILURE;
        } else if ($password !== $passwordRepeat) {
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Wprowadzone hasła różnią się.');
            return Command::FAILURE;
        }

        return $password;
    }


}
