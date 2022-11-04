<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class AboutController
{
    public function __construct(
        private Factory $view,
    ) {}

    public function __invoke(): View
    {
        return $this->view->make('about');
    }
}
