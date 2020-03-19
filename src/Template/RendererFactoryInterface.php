<?php declare(strict_types=1);


namespace CodeGenerator\Template;

interface RendererFactoryInterface
{
    /**
     * @param string $path
     *
     * @return \CodeGenerator\Template\RendererInterface
     */
    public function create(string $path): RendererInterface;
}
