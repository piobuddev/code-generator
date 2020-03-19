<?php declare(strict_types=1);


namespace CodeGenerator\File\Writer;

use CodeGenerator\File\FilesystemInterface;

class FileWriter implements WriterInterface
{
    /**
     * @var \CodeGenerator\File\FilesystemInterface
     */
    protected FilesystemInterface $filesystem;

    /**
     * @param \CodeGenerator\File\FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param string $content
     * @param string $destination
     */
    public function write(string $content, string $destination): void
    {
        $this->filesystem->dumpFile($destination, $content);
    }
}
