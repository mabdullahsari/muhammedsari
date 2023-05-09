<?php declare(strict_types=1);

namespace Previewing;

final readonly class CacheKey
{
    private const SEPARATOR = '_';
    private const WHITESPACE = ' ';

    public static function for(string $text): string
    {
        return str_replace(self::WHITESPACE, self::SEPARATOR, strtolower($text));
    }
}
