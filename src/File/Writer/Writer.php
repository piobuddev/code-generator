<?php declare(strict_types=1);


namespace CodeGenerator\File\Writer;

use CodeGenerator\File\FilesystemInterface;

class Writer implements WriterInterface
{
    /**
     * @var \CodeGenerator\File\FilesystemInterface
     */
    private FilesystemInterface $filesystem;

    /**
     * @var \CodeGenerator\File\Writer\WriterFactory
     */
    private WriterFactory $factory;

    /**
     * @param \CodeGenerator\File\FilesystemInterface  $filesystem
     * @param \CodeGenerator\File\Writer\WriterFactory $factory
     */
    public function __construct(
        FilesystemInterface $filesystem,
        WriterFactory $factory
    ) {
        $this->filesystem = $filesystem;
        $this->factory    = $factory;
    }

    /**
     * @param string $content
     * @param string $destination
     */
    public function write(string $content, string $destination): void
    {
        $type = $this->getWriterType($destination);

        $this->factory->create($type)->write($content, $destination);
    }

    /**
     * @param string $destination
     *
     * @return \CodeGenerator\File\Writer\WriterType
     */
    private function getWriterType(string $destination): WriterType
    {
        $fileExists = $this->filesystem->exists($destination);
        $type = $fileExists ? WriterType::TAG_WRITER : WriterType::FILE_WRITER;

        return WriterType::create($type);
    }
}
