<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\OpenGraph;

use Blogging\Contract\GetPostTitle;
use Blogging\CouldNotFindPost;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Previewing\Contract\Previewer;

final readonly class PreviewBlogPostController
{
    private const ONE_WEEK = 604_800;

    public function __construct(
        private GetPostTitle $posts,
        private Previewer $preview,
        private ResponseFactory $response,
    ) {}

    /** @throws CouldNotFindPost */
    public function __invoke(string $slug): Response
    {
        $preview = $this->preview->get(
            $this->posts->getTitleBySlug($slug)
        );

        return $this->response
            ->make($preview->image)
            ->header('Content-Type', $preview->type)
            ->header('Content-Length', (string) $preview->sizeInBytes)
            ->setClientTtl(self::ONE_WEEK);
    }
}
