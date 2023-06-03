<?php declare(strict_types=1);

namespace App\Http\Site\OpenGraph;

use Blogging\Contract\GetPostTitle;
use Blogging\CouldNotFindPost;
use Previewing\Contract\Previewer;

final readonly class PreviewBlogPostController
{
    public function __construct(private GetPostTitle $posts, private Previewer $preview) {}

    /** @throws CouldNotFindPost */
    public function __invoke(string $slug): OpenGraphResponse
    {
        $title = $this->posts->getTitleBySlug($slug);

        $preview = $this->preview->get($title);

        return new OpenGraphResponse($preview);
    }
}
