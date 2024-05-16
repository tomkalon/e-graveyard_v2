<?php

namespace App\Admin\Infrastructure\Cli;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:project:check-files',
    description: 'Configuration, first launch of the project.',
)]
class CheckFilesCommand extends Command
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

        $createUploadDirectoriesCommand = $application->find('app:create-upload-directory');
        $createUploadDirectoriesCommand->run($input, $output);

        $createCustomStylesCommand = $application->find('app:create-custom-style-directory');
        $createCustomStylesCommand->run($input, $output);

        $createCustomRoutesCommand = $application->find('app:create-custom-routes-directory');
        $createCustomRoutesCommand->run($input, $output);

        $formatter = new FormatterHelper();
        $output->writeln('<fg=black;bg=green>Checking files has been completed successfully.</>');

        return Command::SUCCESS;
    }
}
