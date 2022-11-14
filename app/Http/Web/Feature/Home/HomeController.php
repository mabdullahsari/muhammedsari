<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Home;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\RouteAttributes\Attributes\Get;

final readonly class HomeController
{
    public function __construct(
        private Factory $view,
    ) {}

    #[Get('/', 'home')]
    public function index(): View
    {
        return $this->view->make('Home::Index');
    }
}
