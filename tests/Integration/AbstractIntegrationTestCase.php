<?php declare(strict_types=1);


namespace CodeGenerator\Test;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class AbstractIntegrationTestCase extends TestCase
{
    private Application $application;
    private ContainerInterface $container;

    /**
     * @return \Symfony\Component\Console\Application
     * @throws \Exception
     */
    protected function getApplication(): Application
    {
        if (isset($this->application)) {
            return $this->application;
        }

        $container     = $this->getContainer();
        $application   = $container->get(Application::class);
        $commandLoader = $container->get(ContainerCommandLoader::class);
        $application->setCommandLoader($commandLoader);

        return $this->application = $application;
    }

    /**
     * @return \Psr\Container\ContainerInterface
     * @throws \Exception
     */
    protected function getContainer(): ContainerInterface
    {
        if (isset($this->container)) {
            return $this->container;
        }

        $container = new ContainerBuilder();
        $loader    = new YamlFileLoader($container, new FileLocator(__DIR__));
        $loader->load(__DIR__ . '/../../config/services.yaml');
        $container->compile();

        return $this->container = $container;
    }
}
