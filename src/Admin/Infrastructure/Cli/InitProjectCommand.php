<?php

namespace App\Admin\Infrastructure\Cli;

use App\Core\Domain\Entity\Settings;
use App\Core\Domain\Repository\SettingsRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
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

        $createUploadDirectoriesCommand = $application->find('app:create-upload-directory');
        $createUploadDirectoriesCommand->run($input, $output);

        $createSettingsCommand = $application->find('app:create:settings');
        $createSettingsCommand->run($input, $output);

        $addAdminCommand = $application->find('app:admin:add');
        $addAdminCommand->run($input, $output);

        $output->writeln('Initialization completed successfully.');
        return Command::SUCCESS;
    }
}
