<?php declare(strict_types=1);

namespace Publishing;

interface UrlGenerator
{
    public function generate(string $slug): string;
}
