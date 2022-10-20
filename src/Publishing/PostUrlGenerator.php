<?php declare(strict_types=1);

namespace Domain\Publishing;

final class PostUrlGenerator implements UrlGenerator
{
    public function __construct(
        private readonly string $hostAndScheme,
    ) {}

    public function generate(string $slug): string
    {
        return "{$this->hostAndScheme}/blog/{$slug}";
    }
}
