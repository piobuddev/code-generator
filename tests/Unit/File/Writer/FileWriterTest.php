<?php declare(strict_types=1);


namespace CodeGenerator\Test\File\Writer;

use CodeGenerator\File\FilesystemInterface;
use CodeGenerator\File\Writer\FileWriter;
use CodeGenerator\Test\AbstractUnitTestCase;

class FileWriterTest extends AbstractUnitTestCase
{
    public function testUsesFilesystemToSaveAFile(): void
    {
        $content     = 'some content';
        $destination = 'some destination';
        $filesystem  = $this->createMock(FilesystemInterface::class);
        $filesystem
            ->expects($this->once())
            ->method('dumpFile')
            ->with($destination, $content);

        (new FileWriter($filesystem))->write($content, $destination);
    }
}
