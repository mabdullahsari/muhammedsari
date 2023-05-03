<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Tags;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class TagController
{
    public function __construct(private Factory $view) {}

    public function index(): View
    {
        return $this->view->make('tag-index');
    }

    public function show(string $slug): View
    {
        return $this->view->make('tag-show');
    }
}
