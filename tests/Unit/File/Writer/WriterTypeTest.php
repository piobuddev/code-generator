<?php declare(strict_types=1);


namespace CodeGenerator\Test\File\Writer;

use CodeGenerator\Exceptions\UnexpectedValueException;
use CodeGenerator\File\Writer\TagWriter;
use CodeGenerator\File\Writer\WriterType;
use CodeGenerator\Test\AbstractUnitTestCase;

class WriterTypeTest extends AbstractUnitTestCase
{
    public function testCreatesExpectedInstance(): void
    {
        $this->assertInstanceOf(
            WriterType::class,
            WriterType::create(WriterType::TAG_WRITER)
        );
    }

    public function testThrowsExceptionForUndefinedWriterType(): void
    {
        $this->expectException(UnexpectedValueException::class);

        WriterType::create('foo');
    }

    public function testReturnsExpectedWriterType(): void
    {
        $cut = WriterType::create(WriterType::TAG_WRITER);

        $this->assertEquals(TagWriter::class, $cut->getType());
    }
}
