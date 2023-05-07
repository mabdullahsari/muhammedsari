<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Blog;

use Blogging\Contract\GetSinglePost;
use Blogging\CouldNotFindPost;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ReadBlogPostController
{
    public function __construct(
        private GetSinglePost $posts,
        private Request $request,
        private ResponseFactory $response,
    ) {}

    /** @throws CouldNotFindPost */
    public function __invoke(string $slug): Response
    {
        $post = $this->posts->findBySlug($slug);

        if ($this->request->expectsJson()) {
            return $this->response->json($post);
        }

        return $this->response->view('read-blog-post', $post->toArray());
    }
}
