<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Dive\Utils\Makeable;

final class Post
{
    use Makeable;

    private function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly array $tags,
    ) {}
}
