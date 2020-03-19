<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('config/services.yaml');
$container->compile();

$commands = preg_grep('/CodeGenerator\\\\Command\\\\/', $container->getServiceIds());
foreach ($commands as $command) {
    $application->add($container->get($command));
}
