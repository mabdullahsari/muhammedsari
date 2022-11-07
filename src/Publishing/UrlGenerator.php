<?php declare(strict_types=1);

namespace Core\Publishing;

interface UrlGenerator
{
    public function generate(string $slug): string;
}
