<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Cli;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:project:init',
    description: 'Configuration, first launch of the project.',
)]
class InitProjectCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command makes init project configuration.');
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $application = $this->getApplication();

        $makeMigration = $application->find('doctrine:migrations:migrate');
        $makeMigration->run($input, $output);

        $createSettingsCommand = $application->find('app:create:settings');
        $createSettingsCommand->run($input, $output);

        $addAdminCommand = $application->find('app:admin:add');
        $addAdminCommand->run($input, $output);

        $formatter = new FormatterHelper();

        $output->writeln('<fg=black;bg=green>Initialization has been completed successfully.</>');
        return Command::SUCCESS;
    }
}
