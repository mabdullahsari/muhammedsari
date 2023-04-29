<?php declare(strict_types=1);

namespace App\UI\Http\Site\Tag;

use Blogging\Slug;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Where;

final readonly class TagController
{
    public function __construct(private Factory $view) {}

    #[Get('tags', 'tags.index')]
    public function index(): View
    {
        return $this->view->make('Tag::Index');
    }

    #[Get('tags/{slug}', 'tags.show')]
    #[Where('slug', Slug::PATTERN)]
    public function show(string $slug): View
    {
        return $this->view->make('Tag::Show');
    }
}
