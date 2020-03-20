<?php declare(strict_types=1);


namespace CodeGenerator\Test\Template\Twig\Filters;

use CodeGenerator\Template\Twig\Filters\PluraliseFilter;
use CodeGenerator\Test\AbstractIntegrationTestCase;

class PluraliseFilterTest extends AbstractIntegrationTestCase
{
    public function words(): array
    {
        return [
            ['mugs', 'mug'],
            ['kisses', 'kiss'],
        ];
    }

    /**
     * @dataProvider words
     *
     * @param string $expected
     * @param string $value
     */
    public function testPluralise(string $expected, string $value): void
    {
        $cut = new PluraliseFilter();

        $this->assertEquals($expected, $cut->pluralise($value));
    }
}
