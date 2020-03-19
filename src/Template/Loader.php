<?php declare(strict_types=1);


namespace CodeGenerator\Template;

use Symfony\Component\Finder\Finder;

class Loader
{
    public const TEMPLATE_EXTENSION = '.tmpl';

    /**
     * @var \Symfony\Component\Finder\Finder
     */
    private Finder $finder;

    /**
     * @param \Symfony\Component\Finder\Finder $finder
     */
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param string $path
     *
     * @return \Symfony\Component\Finder\SplFileInfo[]
     */
    public function load(string $path): array
    {
        $files = $this->finder->files()->in($path)->name('*' . self::TEMPLATE_EXTENSION);

        return iterator_to_array($files, false);
    }
}
