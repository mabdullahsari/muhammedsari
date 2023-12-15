<?php declare(strict_types=1);

namespace Previewing;

final readonly class CacheKey
{
    private const string SEPARATOR = '_';
    private const string WHITESPACE = ' ';

    private function __construct() {}

    public static function for(string $text): string
    {
        return str_replace(self::WHITESPACE, self::SEPARATOR, strtolower($text));
    }
}
