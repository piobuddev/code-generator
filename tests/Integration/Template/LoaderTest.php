<?php declare(strict_types=1);


namespace CodeGenerator\Test\Template;

use CodeGenerator\Template\Loader;
use CodeGenerator\Test\AbstractIntegrationTestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class LoaderTest extends AbstractIntegrationTestCase
{
    public function testReturnsTemplates(): void
    {
        $finder    = new Finder();
        $cut       = new Loader($finder);
        $templates = $cut->load(__DIR__ . '/templates');

        $this->assertIsArray($templates);
        $this->assertCount(2, $templates);
        $this->assertInstanceOf(SplFileInfo::class, $templates[0]);
    }
}
