<?php declare(strict_types=1);


namespace CodeGenerator\Test\Command;

use CodeGenerator\Test\AbstractIntegrationTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateCommandTest extends AbstractIntegrationTestCase
{
    /**
     * @var \Symfony\Component\Console\Tester\CommandTester
     */
    private CommandTester $command;
    private array $arguments = [
        'templates' => __DIR__ . '/templates',
        'output'    => __DIR__ . '/output',
        'context'   => __DIR__ . '/context.json',
    ];

    protected function setUp(): void
    {
        $this->command = new CommandTester($this->getApplication()->find('generate'));

        parent::setUp();
    }

    public static function setUpBeforeClass(): void
    {
        mkdir(__DIR__ . '/output');
        mkdir(__DIR__ . '/templates');

        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        $files = glob(__DIR__ . "/{templates/*,output/*}", GLOB_BRACE);
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        rmdir(__DIR__ . '/output');
        rmdir(__DIR__ . '/templates');

        parent::tearDownAfterClass();
    }

    public function testCommandGeneratesFileFromTemplate(): void
    {
        $template = <<<EOD
Lorem ipsum dolor sit amet, {{ name }}
consectetur adipiscing elit. Nullam mi ligula, vehicula in lacus sit amet, 
convallis hendrerit mi. Duis varius tincidunt mollis
EOD;

        file_put_contents(__DIR__ . '/templates/foo.php.tmpl', $template);
        file_put_contents(__DIR__ . '/templates/{{name}}.php.tmpl', '');

        $this->command->execute($this->arguments);

        $expected = <<<EOD
Lorem ipsum dolor sit amet, command
consectetur adipiscing elit. Nullam mi ligula, vehicula in lacus sit amet, 
convallis hendrerit mi. Duis varius tincidunt mollis
EOD;

        $this->assertFileExists(__DIR__ . '/output/foo.php');
        $this->assertFileExists(__DIR__ . '/output/command.php');
        $this->assertEquals($expected, file_get_contents(__DIR__ . '/output/foo.php'));
    }

    public function testCommandInsertsTemplateInTagPlaceFor(): void
    {
        $content  = 'Nullam eros justo, eleifend vitae magna viverra';
        $fileName = 'bar.php';
        $tag      = '###INSERT###';
        $expected = $content . PHP_EOL . $tag;

        file_put_contents(__DIR__ . "/output/{$fileName}", $tag);
        file_put_contents(__DIR__ . "/templates/{$fileName}.tmpl", $content);

        $this->command->execute($this->arguments);

        $this->assertEquals(
            $expected,
            file_get_contents(__DIR__ . "/output/{$fileName}")
        );
    }
}
