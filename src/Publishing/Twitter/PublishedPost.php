<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

final class PublishedPost
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly array $tags,
    ) {}
}
