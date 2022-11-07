<?php declare(strict_types=1);

namespace App\Web\Blog;

use Core\Blogging\Slug;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Where;

final readonly class PostController
{
    public function __construct(
        private Factory $view,
    ) {}

    #[Get('blog', 'posts.index')]
    public function index(): View
    {
        return $this->view->make('Blog.Index');
    }

    #[Get('blog/{slug}', 'posts.show')]
    #[Where('slug', Slug::PATTERN)]
    public function show(string $slug): View
    {
        return $this->view->make('Blog.Show');
    }
}
