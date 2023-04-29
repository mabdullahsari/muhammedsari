<?php declare(strict_types=1);

namespace App\UI\Http\Site\About;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\RouteAttributes\Attributes\Get;

final readonly class AboutController
{
    public function __construct(private Factory $view) {}

    #[Get('about', 'about')]
    public function index(): View
    {
        return $this->view->make('About::Index');
    }
}
