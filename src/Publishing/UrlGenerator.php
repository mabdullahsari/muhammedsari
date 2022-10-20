<?php declare(strict_types=1);

namespace Domain\Publishing;

interface UrlGenerator
{
    public function generate(string $slug): string;
}
