<?php declare(strict_types=1);

namespace App\Web\View\Composers;

use Core\Identity\User;
use Illuminate\Contracts\View\View;

final readonly class MeComposer
{
    public function __construct(
        private User $model,
    ) {}

    public function compose(View $view): void
    {
        $view->with('me', $this->model->newQuery()->sole());
    }
}
