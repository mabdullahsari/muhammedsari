<?php declare(strict_types=1);

namespace Html;

interface HtmlBeautifier
{
    public function beautify(string $html): string;
}
