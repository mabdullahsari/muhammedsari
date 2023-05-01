<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Home;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class HomeController
{
    public const INDEX = '/';

    public function __construct(private Factory $view) {}

    public function index(): View
    {
        return $this->view->make('Home::Index');
    }
}
