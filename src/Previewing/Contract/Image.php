<?php declare(strict_types=1);

namespace Previewing\Contract;

final readonly class Image
{
    public function __construct(
        public string $source,
        public string $type,
    ) {}
}
