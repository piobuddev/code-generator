<?php declare(strict_types=1);


namespace CodeGenerator\Service;

use CodeGenerator\Command\GenerateCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;

class ContainerCommandLoaderFactory
{
    /**
     * @var \Psr\Container\ContainerInterface
     */
    private ContainerInterface $container;
    private array $commandMap = [
        'generate' => GenerateCommand::class,
    ];

    /**
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return \Symfony\Component\Console\CommandLoader\ContainerCommandLoader
     */
    public function create(): ContainerCommandLoader
    {
        return new ContainerCommandLoader($this->container, $this->commandMap);
    }
}
