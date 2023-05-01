<?php declare(strict_types=1);

namespace HtmlBeautifier;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string beautify(string $html)
 */
final class Html extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return HtmlBeautifier::class;
    }
}
