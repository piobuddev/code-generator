<?php declare(strict_types=1);

namespace CodeGenerator\Template\Twig;

use CodeGenerator\Template\RendererFactoryInterface;
use CodeGenerator\Template\RendererInterface;
use CodeGenerator\Template\Twig\Filters\PluraliseFilter;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;

class RendererFactory implements RendererFactoryInterface
{
    /**
     * @var \Twig\Loader\FilesystemLoader
     */
    private FilesystemLoader $filesystemLoader;

    /**
     * @param \Twig\Loader\FilesystemLoader $filesystemLoader
     */
    public function __construct(FilesystemLoader $filesystemLoader)
    {
        $this->filesystemLoader = $filesystemLoader;
    }

    /**
     * @param string $path
     *
     * @return \CodeGenerator\Template\RendererInterface
     */
    public function create(string $path): RendererInterface
    {
        $this->filesystemLoader->setPaths($path);

        $twig = new Environment($this->filesystemLoader);
        $twig->addFilter(new TwigFilter('pluralise', [PluraliseFilter::class, 'pluralise']));

        return new EnvironmentAdapter($twig);
    }
}
