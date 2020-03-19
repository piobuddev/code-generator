<?php declare(strict_types=1);


namespace CodeGenerator\Test\File\Writer;

use CodeGenerator\File\FilesystemInterface;
use CodeGenerator\File\Writer\FileWriter;
use CodeGenerator\File\Writer\TagWriter;
use CodeGenerator\File\Writer\Writer;
use CodeGenerator\File\Writer\WriterFactory;
use CodeGenerator\File\Writer\WriterInterface;
use CodeGenerator\File\Writer\WriterType;
use CodeGenerator\Test\AbstractUnitTestCase;

class WriterTest extends AbstractUnitTestCase
{

    public function typeProvider(): array
    {
        return [
            [true, TagWriter::class], [false, FileWriter::class]
        ];
    }

    /**
     * @dataProvider typeProvider
     *
     * @param bool   $fileExists
     * @param string $type
     */
    public function testDeterminesCorrectWriterType(bool $fileExists, string $type): void
    {
        $destination = '/some/path';
        $content     = 'some content';

        $writer = $this->createMock(WriterInterface::class);
        $writer
            ->expects($this->once())
            ->method('write')
            ->with($content, $destination);

        $filesystem = $this->createMock(FilesystemInterface::class);
        $filesystem
            ->expects($this->once())
            ->method('exists')
            ->with($destination)
            ->willReturn($fileExists);

        $factory = $this->createMock(WriterFactory::class);
        $factory
            ->expects($this->once())
            ->method('create')
            ->with(
                $this->callback(
                    function ($writerType) use ($type) {
                        return $writerType->getType() === $type;
                    }
                )
            )->willReturn($writer);

        $cut = new Writer($filesystem, $factory);
        $cut->write($content, $destination);
    }
}
