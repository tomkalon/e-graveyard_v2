<?php

namespace App\Admin\Infrastructure\Cli;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:create-custom-style-directory',
    description: 'Creates custom styles file',
)]
class CreateCustomStyleDirectoryCommand extends Command
{
    public function __construct(
        private readonly Filesystem $filesystem
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command creates custom styles file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $flag = false;

        $file = 'assets/styles/custom.scss';
        $fileJS = 'assets/js/bundles/custom.js';

        if (!file_exists($file)) {
            $this->filesystem->touch($file);
            $flag = true;
        }

        if (!file_exists($fileJS)) {
            $this->filesystem->touch($fileJS);
            $flag = true;
        }

        if ($flag) {
            $output->writeln('<fg=black;bg=green>Custom files has been created successfully.</>');
        } else {
            $output->writeln('<fg=black;bg=yellow>Custom files -> No changes were made.</>');
        }
        return Command::SUCCESS;
    }
}
