<?php declare(strict_types=1);

namespace Blogging\Contract;

final readonly class Tag
{
    public function __construct(
        public string $slug,
        public string $name,
    ) {}
}
