<?php declare(strict_types=1);

namespace Core\Blogging;

use Core\Blogging\Models\Tag;

final readonly class TagViewModel
{
    public function __construct(
        public string $slug,
        public string $name,
    ) {}

    public static function fromEloquent(Tag $tag): self
    {
        return new self($tag->slug, $tag->name);
    }
}
