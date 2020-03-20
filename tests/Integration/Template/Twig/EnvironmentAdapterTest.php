<?php declare(strict_types=1);


namespace CodeGenerator\Test\Template\Twig;

use CodeGenerator\Template\Twig\EnvironmentAdapter;
use CodeGenerator\Test\AbstractIntegrationTestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class EnvironmentAdapterTest extends AbstractIntegrationTestCase
{
    public function testRendersTemplate(): void
    {
        $twig = new Environment(new FilesystemLoader(__DIR__ . '/../templates'));
        $cut  = new EnvironmentAdapter($twig);

        $this->assertEquals(
            'foo' . PHP_EOL,
            $cut->renderTemplate('foo.test.tmpl', ['name' => 'foo'])
        );
    }

    public function testRendersString(): void
    {
        $twig = new Environment(new FilesystemLoader(__DIR__ . '/../templates'));
        $cut  = new EnvironmentAdapter($twig);

        $this->assertEquals(
            'bar',
            $cut->renderString('{{name}}', ['name' => 'bar'])
        );
    }
}
