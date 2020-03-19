<?php declare(strict_types=1);


namespace CodeGenerator\Template\Twig;

use CodeGenerator\Template\RendererInterface;
use Twig\Environment;

class EnvironmentAdapter implements RendererInterface
{
    /**
     * @var \Twig\Environment
     */
    private Environment $twig;

    /**
     * @param \Twig\Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param string $path
     * @param array  $context
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function renderTemplate(string $path, array $context = []): string
    {
        return $this->twig->render($path, $context);
    }

    /**
     * @param string $value
     * @param array  $context
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function renderString(string $value, array $context): string
    {
        $template = $this->twig->createTemplate($value);

        return $this->twig->render($template, $context);
    }
}
