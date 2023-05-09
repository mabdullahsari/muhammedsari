<?php declare(strict_types=1);

namespace Blogging\Contract;

use DateTimeImmutable;
use JsonSerializable;

final readonly class PostSummary implements JsonSerializable
{
    public function __construct(
        public DateTimeImmutable $publishedAt,
        public string $slug,
        public string $summary,
        public array $tags,
        public string $title,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'published_at' => $this->publishedAt->format(DateTimeImmutable::ATOM),
            'slug' => $this->slug,
            'summary' => $this->summary,
            'tags' => $this->tags,
            'title' => $this->title,
        ];
    }
}
