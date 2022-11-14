<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Blog;

use Core\Blogging\Slug;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Where;
use Symfony\Component\HttpFoundation\Response;

final readonly class GetSinglePostController
{
    public function __construct(
        private GetSinglePost $query,
        private Request $request,
        private ResponseFactory $response,
    ) {}

    #[Get('blog/{slug}')]
    #[Where('slug', Slug::PATTERN)]
    public function __invoke(string $slug): Response
    {
        $post = $this->query->get($slug);

        if ($this->request->expectsJson()) {
            return $this->response->json($post);
        }

        return $this->response->view('Blog::GetSinglePost', ['post' => $post]);
    }
}
