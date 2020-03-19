<?php declare(strict_types=1);


namespace CodeGenerator\File\Writer;

interface WriterInterface
{
    /**
     * @param string $content
     * @param string $destination
     */
    public function write(string $content, string $destination): void;
}
