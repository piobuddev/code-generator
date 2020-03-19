<?php declare(strict_types=1);


namespace CodeGenerator\Test\File\Writer;

use CodeGenerator\Exceptions\UnexpectedValueException;
use CodeGenerator\File\Writer\WriterFactory;
use CodeGenerator\File\Writer\WriterInterface;
use CodeGenerator\File\Writer\WriterType;
use CodeGenerator\Test\AbstractUnitTestCase;
use Psr\Container\ContainerInterface;

class WriterFactoryTest extends AbstractUnitTestCase
{
    public function testThrowsExceptionForUndefinedWriterType(): void
    {
        $undefinedType = 'foo';
        $container = $this->createMock(ContainerInterface::class);
        $cut = new WriterFactory($container);

        $this->expectException(UnexpectedValueException::class);

        $cut->create(WriterType::create($undefinedType));
    }

    public function testGetWriterFromContainer(): void
    {
        $writerType = WriterType::create(WriterType::TAG_WRITER);
        $writer = $this->createMock(WriterInterface::class);

        $container = $this->createMock(ContainerInterface::class);
        $container
            ->expects($this->once())
            ->method('get')
            ->with($writerType->getType())
            ->willReturn($writer);

        $cut = new WriterFactory($container);

        $this->assertEquals($writer, $cut->create($writerType));
    }

    public function testReturnsTheSameInstanceOfWriterWhenUsedMoreThanOnce(): void
    {
        $writerType = WriterType::create(WriterType::TAG_WRITER);
        $writer = $this->createMock(WriterInterface::class);
        $writer1 = $this->createMock(WriterInterface::class);

        $container = $this->createMock(ContainerInterface::class);
        $container
            ->expects($this->once())
            ->method('get')
            ->with($writerType->getType())
            ->willReturn($writer, $writer1);

        $cut = new WriterFactory($container);
        $writer2 = $cut->create($writerType);

        $this->assertTrue($writer === $cut->create($writerType));
        $this->assertTrue($writer !== $writer1);
        $this->assertTrue($writer === $writer2);
    }
}
