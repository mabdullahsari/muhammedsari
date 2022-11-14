<?php declare(strict_types=1);

namespace App\Web\View\Components;

use Core\Identity\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Page extends Component
{
    public function __construct(
        private readonly ?string $description = null,
        private readonly ?string $name = null,
    ) {}

    public function description(): string
    {
        return $this->description ?? config('feed.feeds.main.description');
    }

    public function me(): User
    {
        return User::me();
    }

    public function title(): string
    {
        return implode(' - ', array_filter([$this->name, config('app.name')]));
    }

    public function render(): View
    {
        return $this->view('components.page');
    }
}
