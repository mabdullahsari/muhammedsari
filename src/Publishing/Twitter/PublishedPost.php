<?php declare(strict_types=1);

namespace Publishing\Twitter;

final readonly class PublishedPost
{
    public function __construct(
        public string $title,
        public string $slug,
        public array $tags,
    ) {}
}
