<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Tag;

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
    #[Where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')]
    public function show(string $slug): View
    {
        return $this->view->make('Tag::Show');
    }
}
