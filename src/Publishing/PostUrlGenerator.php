<?php declare(strict_types=1);

namespace Core\Publishing;

final readonly class PostUrlGenerator implements UrlGenerator
{
    public function __construct(
        private string $hostAndScheme,
    ) {}

    public function generate(string $slug): string
    {
        return "{$this->hostAndScheme}/blog/{$slug}";
    }
}
