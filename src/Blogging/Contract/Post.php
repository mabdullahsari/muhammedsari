<?php declare(strict_types=1);

namespace Blogging\Contract;

use DateTimeImmutable;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

final readonly class Post implements Arrayable, JsonSerializable
{
    public function __construct(
        public string $body,
        public ?DateTimeImmutable $publishedAt,
        public string $slug,
        public string $summary,
        public array $tags,
        public string $title,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'body' => $this->body,
            'published_at' => $this->publishedAt?->format(DateTimeImmutable::ATOM),
            'slug' => $this->slug,
            'summary' => $this->summary,
            'tags' => $this->tags,
            'title' => $this->title,
        ];
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
