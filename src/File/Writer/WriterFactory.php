<?php declare(strict_types=1);


namespace CodeGenerator\File\Writer;

use Psr\Container\ContainerInterface;

class WriterFactory
{
    /**
     * @var array<string, \CodeGenerator\File\Writer\WriterInterface>
     */
    private array $writers = [];

    /**
     * @var \Psr\Container\ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param \CodeGenerator\File\Writer\WriterType $type
     *
     * @return \CodeGenerator\File\Writer\WriterInterface
     */
    public function create(WriterType $type): WriterInterface
    {
        return $this->getWriter($type->getType());
    }

    /**
     * @param string $type
     *
     * @return \CodeGenerator\File\Writer\WriterInterface
     */
    protected function getWriter(string $type): WriterInterface
    {
        if (array_key_exists($type, $this->writers)) {
            return $this->writers[$type];
        }

        return $this->setWriter($this->container->get($type), $type);
    }

    /**
     * @param \CodeGenerator\File\Writer\WriterInterface $writer
     * @param string                                     $type
     *
     * @return \CodeGenerator\File\Writer\WriterInterface
     */
    private function setWriter(WriterInterface $writer, string $type)
    {
        $this->writers[$type] = $writer;

        return $writer;
    }
}
