<?php declare(strict_types=1);

namespace Core\Blogging;

use Carbon\CarbonImmutable;
use JsonSerializable;

final readonly class PostViewModel implements JsonSerializable
{
    public function __construct(
        public string $body,
        public ?CarbonImmutable $publishedAt,
        public string $slug,
        public string $summary,
        public array $tags,
        public string $title,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'body' => $this->body,
            'published_at' => $this->publishedAt?->toIso8601String(),
            'slug' => $this->slug,
            'summary' => $this->summary,
            'tags' => $this->tags,
            'title' => $this->title,
        ];
    }
}
