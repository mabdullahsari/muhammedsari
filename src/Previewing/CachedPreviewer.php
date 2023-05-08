<?php declare(strict_types=1);

namespace Previewing;

use Illuminate\Contracts\Cache\Repository;
use Previewing\Contract\Preview;
use Previewing\Contract\Previewer;

final readonly class CachedPreviewer implements Previewer
{
    public function __construct(private Previewer $next, private Repository $cache) {}

    public function get(string $text): Preview
    {
        /** @var array{image: string, sizeInBytes: int}|null $preview */
        $preview = $this->cache->get($key = md5($text));

        if (is_array($preview)) {
            return Preview::png($preview['image'], $preview['sizeInBytes']);
        }

        $preview = $this->next->get($text);

        $this->cache->forever($key, $preview->toArray());

        return $preview;
    }
}
