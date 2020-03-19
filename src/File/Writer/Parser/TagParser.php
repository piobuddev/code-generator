<?php declare(strict_types=1);


namespace CodeGenerator\File\Writer\Parser;

class TagParser
{
    private const INSERT_TAG = '###INSERT###';

    /**
     * @param string $template
     * @param string $source
     *
     * @return string
     */
    public function parse(string $template, string $source): string
    {
        $patter      = '/' . self::INSERT_TAG . '/';
        $replacement = $template . PHP_EOL . self::INSERT_TAG;

        return preg_replace($patter, $replacement, $source);
    }

    /**
     * @param string $content
     *
     * @return bool
     */
    public function hasTag(string $content): bool
    {
        return 1 === preg_match('/' . self::INSERT_TAG . '/', $content);
    }
}
