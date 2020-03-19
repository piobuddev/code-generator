<?php declare(strict_types=1);


namespace CodeGenerator\File\Writer;

use CodeGenerator\Exceptions\UnexpectedValueException;

class WriterType
{
    public const TAG_WRITER     = 'tag';
    public const FILE_WRITER    = 'file';

    private array $writerMapper = [
        self::TAG_WRITER  => TagWriter::class,
        self::FILE_WRITER => FileWriter::class,
    ];

    private string $type;

    /**
     * @param string $type
     */
    public function __construct(string $type)
    {
        if (!array_key_exists($type, $this->writerMapper)) {
            throw new UnexpectedValueException();
        }

        $this->type = $type;
    }

    /**
     * @param string $type
     *
     * @return \CodeGenerator\File\Writer\WriterType
     */
    public static function create(string $type): self
    {
        return new self($type);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->writerMapper[$this->type];
    }
}
