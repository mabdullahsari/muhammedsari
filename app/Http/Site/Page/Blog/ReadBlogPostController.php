<?php declare(strict_types=1);

namespace App\Http\Site\Page\Blog;

use Blogging\Contract\GetSinglePost;
use Blogging\CouldNotFindPost;
use EstimatingReadingTime\Contract\Estimator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ReadBlogPostController
{
    public function __construct(
        private Estimator $readingTime,
        private GetSinglePost $posts,
        private ResponseFactory $response,
    ) {}

    /** @throws CouldNotFindPost */
    public function __invoke(Request $request, string $slug): Response
    {
        $post = $this->posts->findBySlug($slug);
        $estimatedReadingTime = $this->readingTime->estimate($post->body);

        if ($request->expectsJson()) {
            return $this->response->json($post);
        }

        return $this->response->view('read-blog-post', $post->toArray());
    }
}
