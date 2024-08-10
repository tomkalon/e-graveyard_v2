<?php

namespace App\Core\Application\Service\File;

use App\Core\Domain\Entity\File;
use Exception;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;

class RemoveFileService implements RemoveFileServiceInterface
{
    public function __construct(
    ) {
    }

    public function remove(File $file, string $directory, ?string $thumbnailDirectory = null): bool
    {
        try {
            $filesystem = new Filesystem();

            $path = $directory . '/' . $file->getName() . '.' . $file->getExtension()->value;
            $thumbnailPath = $thumbnailDirectory
                ? $thumbnailDirectory . '/' . $file->getName() . '.' . $file->getExtension()->value
                : null;

            if ($filesystem->exists($path)) {
                $filesystem->remove($path);
            }

            if ($thumbnailPath) {
                if ($filesystem->exists($thumbnailPath)) {
                    $filesystem->remove($thumbnailPath);
                }
            }
        } catch (Exception $e) {
            throw new FileNotFoundException($e->getMessage());
        }

        return true;
    }
}
