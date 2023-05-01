<?php declare(strict_types=1);

namespace HtmlBeautifier;

interface HtmlBeautifier
{
    public function beautify(string $html): string;
}
