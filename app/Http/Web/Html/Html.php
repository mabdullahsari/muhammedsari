<?php declare(strict_types=1);

namespace App\Http\Web\Html;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string beautify(string $html)
 */
final class Html extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'html';
    }
}
