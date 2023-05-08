<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\OpenGraph;

use Blogging\Contract\GetSingleTag;
use Blogging\CouldNotFindTag;
use Previewing\Contract\Previewer;

final readonly class PreviewTagController
{
    private const HASHTAG = '#';

    public function __construct(private GetSingleTag $tags, private Previewer $preview) {}

    /** @throws CouldNotFindTag */
    public function __invoke(string $slug): OpenGraphResponse
    {
        $tag = $this->tags->findBySlug($slug);
        $tag = self::HASHTAG . $tag->name;

        $preview = $this->preview->get($tag);

        return new OpenGraphResponse($preview);
    }
}
