<?php

namespace App\Admin\Infrastructure\Cli;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:create-custom-routes-directory',
    description: 'Creates custom routes directory',
)]
class CreateCustomRoutesDirectoryCommand extends Command
{
    public function __construct(
        private readonly Filesystem $filesystem
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command creates custom routes directory');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $flag = false;

        $fileWEB = 'config/routes/custom/web/routes.yaml';
        $fileAPI= 'config/routes/custom/api/routes.yaml';

        if (!file_exists($fileWEB)) {
            $this->filesystem->touch($fileWEB);
            $flag = true;
        }

        if (!file_exists($fileAPI)) {
            $this->filesystem->touch($fileAPI);
            $flag = true;
        }

        if ($flag) {
            $output->writeln('Custom routes files has been created successfully.');
        } else {
            $output->writeln('Custom routes files -> No changes were made.');
        }
        return Command::SUCCESS;
    }
}
