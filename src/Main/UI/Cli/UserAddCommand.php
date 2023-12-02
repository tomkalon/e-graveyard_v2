<?php

namespace App\Main\UI\Cli;

use App\Core\Entity\User;
use App\Core\Repository\UserRepository;
use App\Main\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'user:add',
    description: 'Create New User',
)]
class UserAddCommand extends Command
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly UserRepositoryInterface $userRepository
    ) {
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

        // set username
        $addUsername = new Question(
            'Nazwa użytkownika: ',
            false,
        );
        $username = $helper->ask($input, $output, $addUsername);
        if (!$username || !preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Błędna nazwa użytkownika.');
            return Command::FAILURE;
        }
        if ($this->userRepository->findAllObjectAttrValue('username', $username)) {
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Nazwa jest już zajęta.');
            return Command::FAILURE;
        }

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
        }

        // save user
        if ($password === $passwordRepeat) {
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($this->hasher->hashPassword($user, $password));
            $this->userRepository->save($user, true);
            $io->success(sprintf('Konto zostało utworzone: nazwa użytkownika -> %s', $username));
            return Command::SUCCESS;
        } else {
            $io->error('Utworzenie nowego użytkownika zostało anulowane! Wpisane hasła różnią się od siebie.');
            return Command::FAILURE;
        }
    }
}
