<?php declare(strict_types=1);


namespace CodeGenerator\Test\File\Writer;

use CodeGenerator\Exceptions\UnexpectedValueException;
use CodeGenerator\File\FilesystemInterface;
use CodeGenerator\File\Writer\Parser\TagParser;
use CodeGenerator\File\Writer\TagWriter;
use CodeGenerator\File\Writer\WriterInterface;
use CodeGenerator\Test\AbstractUnitTestCase;

class TagWriterTest extends AbstractUnitTestCase
{
    public function testImplementsExpectedInterface(): void
    {
        $filesystem = $this->createMock(FilesystemInterface::class);
        $parser     = $this->createMock(TagParser::class);
        $this->assertInstanceOf(
            WriterInterface::class,
            new TagWriter($filesystem, $parser)
        );
    }

    public function testDoesNotParseAFileWithoutATag(): void
    {
        $filesystem = $this->createMock(FilesystemInterface::class);
        $parser     = $this->createMock(TagParser::class);
        $parser->expects($this->never())->method('parse');
        $parser->expects($this->once())->method('hasTag')->willReturn(false);

        (new TagWriter($filesystem, $parser))->write('', __FILE__);
    }

    public function testParsesFileWithTag(): void
    {
        $content    = 'some content';
        $filesystem = $this->createMock(FilesystemInterface::class);
        $filesystem
            ->expects($this->once())
            ->method('dumpFile')
            ->with(__FILE__, $content);

        $parser     = $this->createMock(TagParser::class);
        $parser->expects($this->once())->method('hasTag')->willReturn(true);
        $parser->expects($this->once())->method('parse')->willReturn($content);

        (new TagWriter($filesystem, $parser))->write('', __FILE__);
    }
}
