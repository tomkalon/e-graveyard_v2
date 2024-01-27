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
    protected function configure(): void
    {
        $this
            ->setHelp('This command creates the necessary upload directories with proper permissions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $flag = false;

        $uploadsDir = 'public/uploads/grave/images';
        $graveDir = 'public/uploads/grave/thumbs';
        $graveThumbnailDir = 'public/uploads/grave/thumbs';

        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
            $flag = true;
        }
        if (!file_exists($graveDir)) {
            mkdir($graveDir, 0755, true);
            $flag = true;
        }
        if (!file_exists($graveThumbnailDir)) {
            mkdir($graveThumbnailDir, 0755, true);
            $flag = true;
        }

        chown($uploadsDir, 'www-data');
        chown($graveDir, 'www-data');
        chown($graveThumbnailDir, 'www-data');

        if ($flag) {
            $output->writeln('Upload directories created successfully.');
        } else {
            $output->writeln('Upload directories -> No changes were made.');
        }
        return Command::SUCCESS;
    }
}
