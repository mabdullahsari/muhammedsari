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
        $cacheKey = md5($text);

        /** @var array{image: string, sizeInBytes: int}|null $cachedPreviewArray */
        $cachedPreviewArray = $this->cache->get($cacheKey);

        if ($cachedPreviewArray) {
            return Preview::png($cachedPreviewArray['image'], $cachedPreviewArray['sizeInBytes']);
        }

        $preview = $this->next->get($text);
        $this->cache->forever($cacheKey, $preview->toArray());

        return $preview;
    }
}
