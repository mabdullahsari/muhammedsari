<?php declare(strict_types=1);

namespace Blogging\Contract;

final readonly class PostPublished
{
    public function __construct(
        public int $id,
        public string $slug,
        public array $tags,
        public string $title,
    ) {}
}
