<?php declare(strict_types=1);


namespace CodeGenerator\Template\Twig\Filters;

use Symfony\Component\Inflector\Inflector;

class PluraliseFilter
{
    /**
     * Returns the plural form of a word.
     *
     * If the method can't determine the form with certainty, original value is returned.
     *
     * @param string $value
     *
     * @return string
     */
    public static function pluralise(string $value): string
    {
        $result = Inflector::pluralize($value);

        return is_array($result) ? $value : $result;
    }
}
