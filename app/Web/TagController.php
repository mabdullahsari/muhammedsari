<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class TagController
{
    public function __construct(
        private readonly Factory $view,
    ) {}

    public function index(): View
    {
        return $this->view->make('tags.index');
    }

    public function show(string $slug): View
    {
        return $this->view->make('tags.show');
    }
}
