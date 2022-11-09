<?php declare(strict_types=1);

namespace App\Web\Blog;

use Core\Blogging\PostViewModel;
use Core\Blogging\Slug;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Where;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class GetSinglePostController
{
    public function __construct(
        private GetSinglePost $post,
        private Request $request,
        private ResponseFactory $response,
    ) {}

    #[Get('blog/{slug}')]
    #[Where('slug', Slug::PATTERN)]
    public function show(string $slug): Response
    {
        $post = $this->post->get($slug);

        if (! $post instanceof PostViewModel) {
            throw new NotFoundHttpException();
        }

        if ($this->request->expectsJson()) {
            return $this->response->json($post);
        }

        return $this->response->view('Blog.GetSinglePost', ['post' => $post]);
    }
}
