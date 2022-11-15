<?php declare(strict_types=1);

namespace App\Http\Web\Html;

interface HtmlBeautifier
{
    public function beautify(string $html): string;
}
