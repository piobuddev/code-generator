<?php declare(strict_types=1);


namespace CodeGenerator\File\Writer;

use CodeGenerator\Exceptions\UnexpectedValueException;
use CodeGenerator\File\FilesystemInterface;
use CodeGenerator\File\Writer\Parser\TagParser;

class TagWriter extends FileWriter implements WriterInterface
{
    /**
     * @var \CodeGenerator\File\Writer\Parser\TagParser
     */
    private TagParser $parser;

    /**
     * @param \CodeGenerator\File\FilesystemInterface     $filesystem
     * @param \CodeGenerator\File\Writer\Parser\TagParser $parser
     */
    public function __construct(
        FilesystemInterface $filesystem,
        TagParser $parser
    ) {
        $this->parser = $parser;

        parent::__construct($filesystem);
    }

    /**
     * @param string $content
     * @param string $destination
     */
    public function write(string $content, string $destination): void
    {
        $source = file_get_contents($destination);
        if (false === $source) {
            throw new UnexpectedValueException();
        }

        if (!$this->parser->hasTag($source)) {
            return;
        }

        $content = $this->parser->parse($content, $source);

        parent::write($content, $destination);
    }
}
