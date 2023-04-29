<?php declare(strict_types=1);

namespace Blogging\Contract;

use JsonSerializable;

final readonly class Tag implements JsonSerializable
{
    public function __construct(
        public string $slug,
        public string $name,
    ) {}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
