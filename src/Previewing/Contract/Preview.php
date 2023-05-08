<?php declare(strict_types=1);

namespace Previewing\Contract;

use Illuminate\Contracts\Support\Arrayable;

final readonly class Preview implements Arrayable
{
    private const PNG = 'image/png';

    private function __construct(
        public string $image,
        public int $sizeInBytes,
        public string $type,
    ) {}

    public static function png(string $image, int $sizeInBytes): self
    {
        return new self($image, $sizeInBytes, self::PNG);
    }

    public function extension(): string
    {
        return explode(DIRECTORY_SEPARATOR, $this->type)[1];
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
