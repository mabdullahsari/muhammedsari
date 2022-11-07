<?php declare(strict_types=1);

namespace App\Web;

use Core\Identity\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View as ViewFactory;
use Illuminate\View\Component;

final class Page extends Component
{
    private ?User $me = null;

    public function __construct(
        private readonly ?string $name = null,
    ) {}

    public function description(): string
    {
        return Config::get('feed.feeds.main.description'); // @phpstan-ignore-line
    }

    public function me(): Model
    {
        if ($this->me instanceof User) {
            return $this->me;
        }

        return $this->me = User::sole();
    }

    public function title(): string
    {
        $app = Config::get('app.name');

        return $this->name ? "{$this->name} - {$app}" : $app; // @phpstan-ignore-line
    }

    public function render(): View
    {
        return ViewFactory::make('components.page');
    }
}
