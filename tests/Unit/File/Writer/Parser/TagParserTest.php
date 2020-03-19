<?php declare(strict_types=1);


namespace CodeGenerator\Test\File\Writer\Parser;

use CodeGenerator\File\Writer\Parser\TagParser;
use CodeGenerator\Test\AbstractUnitTestCase;

class TagParserTest extends AbstractUnitTestCase
{
    public function testDetectsTag(): void
    {
        $cut = new TagParser();

        $this->assertTrue($cut->hasTag('some content ###INSERT###'));
        $this->assertFalse($cut->hasTag('some content'));
    }

    public function testParsesTag(): void
    {
        $cut      = new TagParser();
        $template = 'foo';
        $source   = 'bar ###INSERT###';
        $expected = 'bar foo' . PHP_EOL . '###INSERT###';

        $this->assertEquals($expected, $cut->parse($template, $source));
    }
}
