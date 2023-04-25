<?php declare(strict_types=1);

namespace Blogging\Contract;

use Carbon\CarbonImmutable;
use JsonSerializable;

final readonly class PostSummary implements JsonSerializable
{
    public function __construct(
        public CarbonImmutable $publishedAt,
        public string $slug,
        public string $summary,
        public string $title,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'published_at' => $this->publishedAt->toIso8601String(),
            'slug' => $this->slug,
            'summary' => $this->summary,
            'title' => $this->title,
        ];
    }
}
