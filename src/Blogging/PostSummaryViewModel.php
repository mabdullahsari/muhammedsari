<?php declare(strict_types=1);

namespace Core\Blogging;

use Carbon\CarbonImmutable;
use Core\Blogging\Models\Post;
use JsonSerializable;

final readonly class PostSummaryViewModel implements JsonSerializable
{
    public function __construct(
        public CarbonImmutable $publishedAt,
        public string $slug,
        public string $summary,
        public string $title,
    ) {}

    public static function fromEloquent(Post $post): self
    {
        return new self($post->published_at, $post->slug, $post->summary, $post->title);
    }

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
