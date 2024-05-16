<?php

namespace App\Admin\Infrastructure\Cli;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-upload-directory',
    description: 'Creates directories for uploading files with www-data permissions',
)]
class CreateUploadDirectoryCommand extends Command
{
    public function __construct(
        private readonly string $graveImagePath,
        private readonly string $graveImageThumbPath,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command creates the necessary upload directories with proper permissions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $flag = false;

        $uploadsDir = 'public/uploads/';

        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
            $flag = true;
        }
        if (!file_exists($this->graveImagePath)) {
            mkdir($this->graveImagePath, 0755, true);
            $flag = true;
        }
        if (!file_exists($this->graveImageThumbPath)) {
            mkdir($this->graveImageThumbPath, 0755, true);
            $flag = true;
        }

        if ($flag) {
            chown($uploadsDir, 'www-data');
            chown($this->graveImagePath, 'www-data');
            chown($this->graveImageThumbPath, 'www-data');
            $output->writeln('<fg=black;bg=green>Upload directories created successfully.</>');
        } else {
            $output->writeln('<fg=black;bg=yellow>Upload directories -> No changes were made.</>');
        }
        return Command::SUCCESS;
    }
}
