<?php declare(strict_types=1);


namespace CodeGenerator\File;

use Symfony\Component\Filesystem\Filesystem;

class SymfonyFilesystemAdapter implements FilesystemInterface
{
    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private Filesystem $filesystem;

    /**
     * @param \Symfony\Component\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @inheritDoc
     */
    public function exists(string $file): bool
    {
        return $this->filesystem->exists($file);
    }

    /**
     * @param string $file
     * @param string $content
     */
    public function dumpFile(string $file, string $content): void
    {
        $this->filesystem->dumpFile($file, $content);

        return;
    }
}
