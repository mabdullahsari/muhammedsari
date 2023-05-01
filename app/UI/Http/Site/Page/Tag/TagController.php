<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Tag;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class TagController
{
    public function __construct(private Factory $view) {}

    public function index(): View
    {
        return $this->view->make('Tag::Index');
    }

    public function show(string $slug): View
    {
        return $this->view->make('Tag::Show');
    }
}
