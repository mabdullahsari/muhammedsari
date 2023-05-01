<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\About;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class AboutController
{
    public const INDEX = 'about';

    public function __construct(private Factory $view) {}

    public function index(): View
    {
        return $this->view->make('about');
    }
}
