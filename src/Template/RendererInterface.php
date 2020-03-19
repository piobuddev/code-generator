<?php declare(strict_types=1);


namespace CodeGenerator\Template;

interface RendererInterface
{
    /**
     * @param string $path Template file path
     * @param array  $context
     *
     * @return string
     */
    public function renderTemplate(string $path, array $context = []): string;

    /**
     * @param string $value
     * @param array  $context
     *
     * @return string
     */
    public function renderString(string $value, array $context): string;
}
