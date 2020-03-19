<?php declare(strict_types=1);


namespace CodeGenerator\File;

interface FilesystemInterface
{
    /**
     * @param string $file
     *
     * @return bool
     */
    public function exists(string $file): bool;

    /**
     * @param string $file
     * @param string $content
     */
    public function dumpFile(string $file, string $content): void;
}
